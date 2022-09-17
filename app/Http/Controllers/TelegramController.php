<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    protected $ngrok_domain;
    protected $access_token;
    protected $service;

    public function __construct()
    {
        $this->ngrok_domain = config('telegram.ngrok_domain');
        $this->access_token = config('telegram.bots.mybot.token');
    }

    protected function setWebhook()
    {
        return  $this->sendTelegramData('setwebhook', [
            'query' => [ 'url' => $this->ngrok_domain . '/' . $this->access_token ]
        ]);
    }

    protected function sendTelegramData($route = '', $params = [], $method = 'POST')
    {
        $client = new Client(['base_uri' => 'https://api.telegram.org/bot' . $this->access_token . '/']);
        $result = $client->request($method, $route, $params);

        return (string) $result->getBody();
    }

    public function action(Request $request)
    {
        $chat_id = $request->get('message')['chat']['id'];
        $message = $request->get('message')['text'];
        if ($message == 'hi') {
            $text = 'Hello';
        }
        else {
            $text = 'I don\'t understand you';
        }
       Telegram::sendMessage(['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML']);
      return $request->all();
    }
}
