<?php

namespace App;

use GuzzleHttp\Client;

use App\Todo;



class Bot {
    private $client;
    public function __construct () {
        $this->client = new Client([
            'base_uri'=>"https://api.telegram.org/bot" . $_ENV['TELEGRAM_BOT_TOKEN'] . "/"
        ]);
    }
    public function makeRequest (string $method, array $params): void
    {
        $this->client->post($method, ['json' => $params]);
    }

    public  function getUserTasks(int $chat_id): array
    {
        $todo = new Todo();

        return $todo->getAllTodosTelegramById($chat_id);
    }
    public function prepareTasklist($chat_id): string
    {
        $tasks=$this->prepareTasklist($chat_id);
        $tasksList = "Your tasks:\n";
        foreach ($tasks as $task){
            $tasksList .= $task['title']."\n";
            $tasksList .= $task['due_date']."\n";
            $tasksList .= $task['status']."\n\n";
            $tasksList .= "------------------\n\n";
        }
        return $tasksList;
    }
    public function  prepareButton(int $chat_id): array
    {
        $tasks=$this->prepareTasklist($chat_id);
        $buttons=[];
        foreach ($tasks as $task){
            $buttons[]=[
                [
                    'text'=>$task['title'],
                    'callback_data'=>$task['id']
                ]
            ];
        }

        return $buttons;
    }
    public function sentUserTasks(int $chat_id): void
    {
        $taskList = $this->prepareTasklist($chat_id);
        foreach ($taskList as $task) {
            $taskList->prepareTasklist($chat_id);
            $this->makeRequest('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>$taskList,
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [
                            [
                                'text'=>'Add Task',
                                'callback_data'=>'add_task'
                            ]
                        ]
                    ]
                ])
            ]);
        }
    }


}