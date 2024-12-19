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
    public function getUserTasks(int $chatId): array{
        $todo = new Todo();

        return $todo->getTodoByTelegramId($chatId);
    }

    public function prepareTaskList (int $chatId): string{
        $i = 0;
        $tasks = $this->getUserTasks($chatId);
        $tasksList = "Your tasks:\n\n";
        foreach ($tasks as $task) {
            $i++;
            $taskList .= "Task #" .$i. "\n";
            $taskList .= $task['title']."\n";
            $taskList .= $task['due_date']."\n";
            $taskList .= $task['status']."\n\n";
            $taskList .= "====================\n\n";
        }
        return $taskList;
    }

    public function prepareButtons (int $chatId): array{
        $i = 0;
        $tasks = $this->getUserTasks($chatId);
        $buttons = [];
        foreach ($tasks as $task) {
            $i++;
            $buttons[]= [
                'text'=>$i,
                'callback_date'=>$task['task_id']
            ];
        }
        return array_chunk($buttons,2);
    }

    public function sendUserTasks(int $chatId): void{
        $taskList = $this->prepareTaskList($chatId);
        $this->makeRequest("sendMessage",[
            "chat_id" => $chatId,
            "text" => $taskList,
            "reply_markup" => json_encode([
                "inline_keyboard" => $this->prepareButtons($chatId),
            ])
        ]);

    }


}
