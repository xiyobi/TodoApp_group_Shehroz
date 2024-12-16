<?php

require 'vendor/autoload.php';


use GuzzleHttp\Client;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$botToken = $_ENV['BOT_TOKEN'];
if (!$botToken) {
    die('Bot token not found in .env file.');
}

$telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

$chat_id = '7585290599';
$message = 'Salom! Bu PHP orqali yuborilgan xabar.';

$client = new Client();

try {
    $response = $client->post($telegramApiUrl, [
        'form_params' => [
            'chat_id' => $chat_id,
            'text' => $message,
        ],
    ]);

    echo "Javob keldi: " . $response->getBody();
} catch (Exception $e) {
    echo "Xatolik: " . $e->getMessage();
}


