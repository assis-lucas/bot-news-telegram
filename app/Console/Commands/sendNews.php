<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SenderService;

class sendNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendNews:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the daily news';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SenderService $sender)
    {   
        parent::__construct();
        $this->sender = $sender;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $this->sender->send();
    }
}
