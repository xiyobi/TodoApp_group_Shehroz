<?php


use App\Bot;

use App\User;

use \App\Todo;

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chatId = $message->chat->id;
$text = $message->text;

$user = new User();

$bot = new Bot();

$todo = new Todo();

if ($text == '/start'){
    $text1 = "Bizning botimizni ishlatish uchun web syatdan royxatdan o'tishingiz zarur (http://localhost:8080)";
    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chatId,
        'text'=>$text1
    ]);
    exit();
}
if(mb_stripos($text,'/start') !== false){
    $userId = explode('/start', $text)[1];
    $user->linkTelegramId($userId, $chatId);

    $bot->makeRequest('sendMessage',[
        'chat_id'=>$chatId,
        'text'=>'Todo App botiga xush kelibsiz'
    ]);
    exit();
}

if ($text == '/tacks') {

$tasks = $todo->getAllTodosTelegramById($chatId);

if (!empty($tasks)) {
    $responseText = "Sizning vazifalaringiz:\n\n";
    foreach ($tasks as $index => $task) {
        $responseText .= ($index + 1) . ". " . $task['title'] . " - " . $task['status'] . " (Muddati: " . $task['due_date'] . ")\n";
    }
} else {
    $responseText = "Hozircha hech qanday vazifa yo'q.";
}

$bot->makeRequest('sendMessage', [
    'chat_id' => $chatId,
    'text' => $responseText
]);

exit();
}







