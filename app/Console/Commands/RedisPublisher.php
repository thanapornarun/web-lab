<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisPublisher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis:publish {topic} {--message=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redis Simple Publisher';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $topic = $this->argument('topic');
        $message = $this->option('message');

        $this->line("publish to topic: {$topic}, message: {$message}");

        Redis::publish($topic, $message);
        return self::SUCCESS;
    }
}