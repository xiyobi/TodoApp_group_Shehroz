<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$botToken = $_ENV['BOT_TOKEN'];
$chatId = $_ENV['CHAT_ID'];
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

if (!$botToken || !$chatId || !$dbHost || !$dbName || !$dbUser || !$dbPass) {
    die("Kerakli sozlamalar .env faylda mavjud emas.");
}


    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM todos");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($users)) {
        die("Database bo'sh. Hech qanday foydalanuvchi topilmadi.");
    }

    $message = "Foydalanuvchilar ro'yxati:\n\n";
    foreach ($users as $user) {
        $message .= "ID: {$user['id']}, Status: {$user['status']}, Name: {$user['title']}\n";
    }

    $client = new Client([
        'base_uri' => "https://api.telegram.org/bot$botToken/",
        'timeout'  => 2.0,
    ]);

    $response = $client->post('sendMessage', [
        'json' => [
            'chat_id' => $chatId,
            'text' => $message,
        ],
    ]);

    $result = json_decode($response->getBody(), true);
    if ($result['ok']) {
        echo "Foydalanuvchilar ro'yxati yuborildi.\n";
    } else {
        echo "Xatolik yuz berdi: " . $result['description'] . "\n";
    }

