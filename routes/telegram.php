<?php


use App\Bot;

use App\User;

use \App\Todo;

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chatId = $message->chat->id;
$text = $message->text;

$callbackQuery = $update->callback_query;
$callbackQueryId = $callbackQuery->id;
$callbackData = $callbackQuery->data;
$callbackUserId = $callbackQuery->from->id;
$callbackChatId = $callbackQuery->message->chat->id;
$callbackMessageId = $callbackQuery->message->message_id;

$redis = new Redis();

$user = new User();

$bot = new Bot();


if($callbackQuery){
    if(mb_stripos($callbackData,'task_') !== false){
        $taskId = explode('task_', $callbackData)[1];
        $todo = (new Todo())->getTodo($taskId);
        $bot->makeRequest('editMessageText',[
            'chat_id'=>$callbackChatId,
            'message_id'=>$callbackMessageId,
            'text'=>'Task: ' . json_encode($todo),
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [
                        ['callback_data'=>'completed_' . $todo['id'], 'text'=>'Complete'],
                        ['callback_data'=>'in_progress_' . $todo['id'], 'text'=>'In progress'],
                        ['callback_data'=>'pending_' . $todo['id'], 'text'=>'Pending'],
                    ],
                    [
                        ['callback_data'=>'edit_' . $todo['id'], 'text'=>'Edit']
                    ]


                ]

            ])
        ]);
    }
    if(mb_stripos($callbackData,'edit_') !== false){
        $taskId = explode('edit_', $callbackData)[1];

        $redis->set('edit_' . $callbackChatId, $taskId);
        $bot->makeRequest('editMessageText',[
            'chat_id'=>$callbackChatId,
            'message_id'=>$callbackMessageId,
            'text'=>'Enter new task:' . $redis->get('edit_' . $callbackChatId),
        ]);
    }
    if(mb_stripos($callbackData,'completed_') !== false){
        $taskId = explode('completed_', $callbackData)[1];
        (new Todo())->updatestatus((int)$taskId,'complete');
    }
    if(mb_stripos($callbackData,'in_progress_') !== false){
        $taskId = explode('in_progress_', $callbackData)[1];
        (new Todo())->updatestatus((int)$taskId,'in_progress');
    }
    if(mb_stripos($callbackData,'pending_') !== false){
        $taskId = explode('pending_', $callbackData)[1];
        (new Todo())->updatestatus((int)$taskId,'pending');
    }
}


if($message){
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
        $bot->sendUserText($chatId);
        exit();

    }
    if ($text) {
        $taskId = $redis->get('edit_' . $chatId);
        if($taskId){
            (new Todo())->updateTitle($taskId, $text);
            $bot->makeRequest('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'Task updated'
            ]);

        }
        $redis->del('edit_' . $chatId);
    }
}







