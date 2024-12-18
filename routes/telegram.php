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



if ($text == '/start'){
    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'Assalomu alykum bot hush kelibsiz'
    ]);
    exit();
}

if (mb_stripos($text, '/start')!==false){
    $userId = explode('/start', $text)[1];
    $user ->setTelegramId($userId,$chat_id);
    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'Assalomu alykum'
    ]);
    exit();
}
if ($text ='/tasks')
{
    $tasks = $todo->getAllTodosTelegramById($chat_id);
    if (!empty($tasks)){
        $responseText = "sizing ishiningiz";
        foreach ($tasks as $index => $task){
            $responseText .= ($index + 1) . ". " . $task['title'] . " - " . $task['status'] . " (Date: " . $task['due_date'] . ")\n";

        }
    }else{
        $responseText = "no found page";
    }

}
if ($text == '/help'){
    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>'Qanady Yordam kerak'
    ]);
    exit();
}
