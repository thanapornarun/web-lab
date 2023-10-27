<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis:subscribe {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redis Simple Subscriber';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $topic = $this->argument('topic');

        $redis = Redis::connection();

        if ($redis->ping()) {
            $this->line("subscribe topic: {$topic}");
            $redis->subscribe([$topic], function (string $message) {
                $this->line("message: {$message}");
            });
        }

    }
}