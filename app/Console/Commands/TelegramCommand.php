<?php

namespace App\Console\Commands;

use App\Models\TelegramSetting;
use App\Models\TelegramCommand as ModelTelegramCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramCommand extends Command
{
    const TELEGRAM_ADDR = 'https://api.telegram.org/bot';
    protected $offsetID = 0;
    /**
     * Создаем команду, для ее нужно будет написать в консоли
     * php artisan command:telegram
     *
     * А если мы захотим записать команды для бота, то вызвать команду:
     * php artisan command:telegram --setCommand
     *
     * @var string
     */
    protected $signature = 'command:telegram {--setCommand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram get and send messages. And set command';

    /**
     * Здесь исполнения нашей команды
     *
     * @return int
     */
    public function handle()
    {
        $getSetting = TelegramSetting::where('name', 'key')->first();
        if(!$getSetting)
            return $this->output->error("Ошибка выполнения программы!\nСоздайте настройку key с ключем от бота");

        if($this->option('setCommand')) {
            $commands = ModelTelegramCommand::all()->toArray();
            if(!$commands) return $this->output->warning('Нет команд');
            $setCommands = [];
            foreach($commands as $command) {
                $setCommands[] = ['command' => $command['command'], 'description' => 'none'];
            }

            Http::post(self::TELEGRAM_ADDR . $getSetting['val'] . '/setMyCommands', ['commands' => $setCommands]);

            return $this->output->success('Успешно установлены данные команд');
        }

        $getAllNewMessages = $this->getUpdates($getSetting['val']);
        if ($getAllNewMessages['status'] > 210)
            return $this->output->error("Ошибка выполнения программы!\nЗапрос выполнен без успешно");

        $sendMessage = [];
        foreach($getAllNewMessages['body']['result'] as $message)
            $sendMessage[] = $this->parsingMessage($message);

        # Создаем новый массив без пустых элементов
        $sendMessage = array_filter($sendMessage, function ($item) {
            return $item != [];
        });

        if($sendMessage == [])
            return $this->output->success('Нет сообщений для отправки, программа завершена!');

        $this->sendMessage($getSetting['val'], $sendMessage);
        $this->setOffsetId($getSetting['val']);

        return Command::SUCCESS;
    }

    /**
     *
     * Получения входящих обновлений
     *
     * @param $key
     * @return array
     */
    private function getUpdates($key) {
        $response = Http::get(self::TELEGRAM_ADDR . $key . '/getUpdates');
        return ['status' => $response->status(), 'body' => $response->json()];
    }

    /**
     *
     * Получение сообщения
     *
     * @param $message
     * @return array
     */
    private function parsingMessage($message) {
        # Получаем идентификатор чата пользователя
        $idUser = $message['message']['from']['id'];

        $this->offsetID = $this->offsetID < $message['update_id'] ? $message['update_id'] : $this->offsetID;

        # Получаем текст который прислал пользователь
        $command = $message['message']['text'];

        # Узнаем, является данный текст командой
        if(!isset($message['message']['entities'])) return [];

        # Вырезаем команду
        # Получается у нас может быть ситуация, что передастся много команд.
        # Сделаем возможность единоразово обрабатывать все команды.
        $commands = [];
        foreach ($message['message']['entities'] as $item)
            $commands[] = mb_substr($command, $item['offset'], $item['length']);
        # Получаем все команды из нашего списка
        $commands = ModelTelegramCommand::whereIn('command', $commands)->get()->toArray();

        # Если нет такой команды ответа не будет
        if($commands == []) return [];

        $textContent = '';
        foreach ($commands as $item)
            $textContent .= $item['context'];

        return ['chat_id' => $idUser, 'text' => $textContent];
    }

    /**
     *
     * Отправка сообщения
     *
     * @param $key
     * @param $messages
     * @return void
     */
    private function sendMessage($key, $messages) {
        foreach ($messages as $item) {
            Http::post(self::TELEGRAM_ADDR . $key . '/sendMessage', $item);
            # После каждого сообщения даем возможность отдохнуть запросу на 300 миллисекунд
            usleep(300);
        }
    }

    /**
     *
     * Запись ключа, чтобы сообщения которые были ранее не выводились
     *
     * @param $key
     * @return void
     */
    private function setOffsetId($key) {
        Http::post(self::TELEGRAM_ADDR . $key . '/getUpdates', ['offset' => $this->offsetID++]);
    }
}
