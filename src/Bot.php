<?php

namespace App;

use GuzzleHttp\Client;

class Bot
{
    private $client;

    public function __construct(){
        $this->client = new Client([
            'base_uri' => "https://api.telegram.org/bot" . $_ENV["TELEGRAM_BOT_TOKEN"] . "/",
        ]);

    }


    public function makeRequest(string $method, array $params){
        $this->client->post($method, ['json' => $params]);
    }
}