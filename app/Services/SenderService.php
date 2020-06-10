<?php

namespace App\Services;

use Telegram\Bot\Api;
use App\Services\SearcherService;
use App\News;

class SenderService
{   

    public function __construct(SearcherService $searcher)
    {   
        $this->searcher = $searcher;
    }

    public function send()
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $data = $this->searcher->getData();

        foreach($data as $i => $message){

            sleep(3);

            $response = $telegram->sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_ID'), 
                'disable_web_page_preview' => true,
                'text' => $this->searcher->formatToMessage($message) 
            ]);

            if($response){
                $this->searcher->markMessageAsSent($message);
            }
        }
    }
}
