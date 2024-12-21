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


    public function makeRequest(string $method, array $params): void
    {
        $this->client->post($method, ['json' => $params]);
    }

    public function getUserTasks(int $chatId): array
    {
        $todo = new Todo();
        return $todo->getAllTodosByTelegramId($chatId);
    }

    public function prepareTaskList(int $chatId): string
    {
        $tasks = $this->getUserTasks($chatId);
        $i = 0;
        if (!empty($tasks)) {
            $responseText = "Sizning vazifalaringiz:\n\n";
            foreach ($tasks as $index => $task) {
                $i++;
                $responseText .= "Task #:" . $i . "\n";
                $responseText .= 'Vazifa ' . ($index + 1) . ': ' . $task['title'] . "\n";
                $responseText .= 'Status: ' . $task['status'] . "\n";
                $responseText .= 'Kiritilgan sana: ' . $task['due_date'] . "\n\n";
                $responseText .= '---------------------------------------' . "\n\n";
            }
        } else {
            $responseText = "Hozircha hech qanday vazifa yo'q.";
        }
        return $responseText;
    }

    public function prepareButtons(int $chatId): array
    {
        $tasks = $this->getUserTasks($chatId);
        $i = 0;
        $buttons = [];
        foreach ($tasks as $task) {
            $i++;
            $buttons[] = [
                'text' => $i,
                'callback_data' => 'task_' . $task['task_id']
            ];
        }
        return array_chunk($buttons, 2);
    }

    public function sendUserText(int $chatId): void
    {
        $responseText = $this->prepareTaskList($chatId);
        $this->makeRequest('sendMessage', [
            'chat_id' => $chatId,
            'text' => $responseText,
            'reply_markup' => json_encode([
                'inline_keyboard'=>$this->prepareButtons($chatId),
            ])
        ]);
    }
}