<?php

use App\Bot;
use App\Todo;
use  App\User;

$todo = new Todo();
$bot = new Bot();
$user = new User();


$update = json_decode(file_get_contents('php://input'));

$chat_id = $update->message->chat->id;
$text = $update->message->text;

$callbackQuery = $update->callback_query;
$callbackQueryId = $callbackQuery->id;
$callbackData = $callbackQuery->data;
$callbackUserId = $callbackQuery->from->id;
$callbackChatId = $callbackQuery->message->chat->id;
$callbackMessageId = $callbackQuery->message->message_id;

if ($text == '/start'){

    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'Assalomu alykum bot hush kelibsiz'
    ]);
    exit();
}

if (mb_stripos($text, '/start')!==false){
    $userId = explode('/start', $text)[1];
    $user ->setTelegramId($userId, $chat_id);
    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'Assalomu alykum'.$userId
    ]);
    exit();
}

if ($text =='/tasks')
{
    $bot->sentUserTasks($chat_id);
    exit();
}
