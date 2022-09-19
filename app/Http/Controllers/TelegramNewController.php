<?php

namespace App\Http\Controllers;

use App\Models\Telegram;

class TelegramNewController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Telegram(env('TELEGRAM_BOT_TOKEN', '5446507810:AAG5K8kBVc_gTRnfZiLdORjPlNbf8ecYrmU'));
    }

    public function setWebHook()
    {
        return $this->telegram->setWebhook(env('NGROK_DOMAIN', 'https://768e-82-215-107-108.eu.ngrok.io') . '/telegram/webhook');
    }

    public function unsetWebHook()
    {
        return $this->telegram->deleteWebhook();
    }

    public function webhook()
    {
        $chat_id = $this->telegram->ChatID();
        $text = $this->telegram->Text();
        $this->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $text
            ]);

        $this->sendMessageMe($text);
    }

    public function sendMessageMe($text)
    {
        \Log::info('sendMessageMe');
         (new Telegram('5610290104:AAEJuqkENwJvxRUHIvSkBuPXwpBYBEjULQU'))->sendMessage([
            'chat_id' => -1001708425003,
            'text' => $text
        ]);

    }
}
