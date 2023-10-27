<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\TextMessage;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\Constants\HTTPHeader;
use LINE\LINEBot\Event\MessageEvent;
use LINE\Parser\EventRequestParser;
use LINE\Webhook\Model\TextMessageContent;
use PHPUnit\Event\InvalidEventException;
use Spatie\FlareClient\Http\Exceptions\InvalidData;
use stdClass;

class LineController extends Controller {
    public function callback( Request $request ) {
        $result = $request->getContent();
        file_put_contents(__DIR__.'/test.txt',$result,FILE_APPEND);
        $events = json_decode($result)->events;
        foreach($events as $event) {
            $obj = new stdClass();
            $replyToken = $event->replyToken;
            $obj->replyToken = $replyToken;
            $obj->messages = [];

            if($event->type == 'message'){

                if ($event->message->type == 'sticker') {
                    $objsticker = new stdClass();  // { } = object 
                    $objsticker->type = 'sticker';
                    $objsticker->packageId = 1;
                    $objsticker->stickerId = 2;
                    $obj->messages[] = $objsticker;
                }

                if($event->message->type == 'text'){
                    $text = $event->message->text;
                    $objtext = new stdClass(); //{}
                    $objtext->type = 'text';
                    $objtext->text = $text;
                    if ($text == 'hello') {
                        $objtext->text = 'world';
                    }
                    $obj->messages[] = $objtext;
                }


            }
            // file_put_contents(__DIR__.'/test.txt',json_encode($obj),FILE_APPEND);
            $this->sendMessage($obj);
        }



    //     $signature = $request->header( HTTPHeader::LINE_SIGNATURE );
    //     // file_put_contents(__DIR__.'/test.txt',json_encode($signature));
    //     $rs = $request->getContent();
    //     // file_put_contents(__DIR__.'/test.txt',json_encode($rs),FILE_APPEND);
    //     try {
    //     $parsedEvents = EventRequestParser::parseEventRequest(json_encode($rs),'1507c77dfdb531aa61fc785da1e9f4d6',$signature);
    //     foreach ($parsedEvents->getEvents() as $event) {
    //         $message = $event->getMessage();
    //         file_put_contents(__DIR__.'/test.txt',json_encode($message));
    //         if ($message instanceof TextMessageContent) {
    //             $replyText = $message->getText();
    //             $messagingApi->replyMessage(new ReplyMessageRequest([
    //                 'replayToken' => $event->getReplyToken(),
    //                 'message' => $replyText
    //             ]));
    //             file_put_contents(__DIR__.'/test.txt',$replyText,FILE_APPEND);
    //         }
    //     }
    // } catch (\Throwable $th) {
    //     //throw $th;
    //     file_put_contents(__DIR__.'/test.txt',$th->getMessage(),FILE_APPEND);
    // }
        // file_put_contents(__DIR__.'/test.txt',"-=-----end----\n",FILE_APPEND);

        
        // var_dump($request);


        // $signature = $request->header( HTTPHeader::LINE_SIGNATURE );
        // if ( empty( $signature ) ) {
        //     return response( 'Bad Request', 400 );
        // }

        // try {
        //     $secret = config( config( 'LINE_BOT_CHANNEL_SECRET' ) );
        //     $parsedEvents = EventRequestParser::parseEventRequest( $request->getContent() );
        // }
        // catch (InvalidSignatureException $e) {
        //     return response()->json('Invalid signature', 400);
        // }
        // catch (InvalidEventException $e) {
        //     return response()->json('Invalid signature', 400);
        // }

        // foreach ($parsedEvents->getEvents() as $event) {
        //     $message = $event->getMessage();
        //     if ($message instanceof TextMessageContent) {
        //         $replyText = $message->getText();
        //         Log::info('Reply Text: ' . $replyText);
        //         if ($replyText == 'hello') {
        //             $messagingApi->replyMessage(new ReplyMessageRequest([
        //                 'replayToken' => $event->getReplyToken(),
        //                 'message' => 
        //             ]))
        //         }
                
        //     }

        // }


    }

    /**
    * Display a listing of the resource.
    */

    public function index() {
        return 'ok';
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        //
    }

    private function logAccess($status = 200)                        
    {                                                        
        file_put_contents("php://stdout", sprintf(           
            "[%s] %s:%s [%s]: %s\n",                         
            date("D M j H:i:s Y"),                           
            $_SERVER["REMOTE_ADDR"],                         
            $_SERVER["REMOTE_PORT"],                         
            $status,                                         
            $_SERVER["REQUEST_URI"]                          
        ));                                                  
    }

    // private function sendMessage($object ,$replytoken){
    private function sendMessage($obj){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.line.me/v2/bot/message/reply',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($obj),
            CURLOPT_HTTPHEADER => array(
                'Accept: */*',
                'Authorization: Bearer wRmdOPDCZ9euGcY348YPi2/qQaq8KARHzZyqY4PLMAN+CVKJZPuEpLRpzDm0BNPwEsGV2EMoQ0wf6fbbzB3KsjhhHNEEocXCRAJbG+9gXjDVBKBMl7xtXtdbRNXNKmJW05eZ7/P8yW5AjtGAzDRS5gdB04t89/1O/w1cDnyilFU=',
                'Content-Type: application/json'
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            file_put_contents(__DIR__.'/test.txt',json_encode($obj),FILE_APPEND);
            file_put_contents(__DIR__.'/test.txt',$response,FILE_APPEND);
    }
}
