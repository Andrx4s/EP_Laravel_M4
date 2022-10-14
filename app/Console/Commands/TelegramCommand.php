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

        $getAllNewMessages = $this->getUpdates($getSetting['val']);
        if ($getAllNewMessages['status'] > 210)
            return $this->output->error("Ошибка выполнения программы!\nЗапрос выполнен без успешно");

        $sendMessage = [];
        foreach ($getAllNewMessages['body'] as $message)
            $sendMessage[] = $this->parsingMessage($message);

        # Создаем новый массив без пустых элементов
        $sendMessage = array_filter($sendMessage, function ($item) {
            return $item != [];
        });

        Log::info('Пришли данные сообщений: ' . json_encode($sendMessage));

        if(!$sendMessage)
            return $this->output->success('Нет сообщений дял отправки, программа завершена!');

        $this->sendMessage($getSetting['val'], $sendMessage);

        return Command::SUCCESS;
    }

    private function getUpdates($key) {
        Log::info('Пришли данные сообщений: ' . json_encode($sendMessage));
        $response = Http::get(self::TELEGRAM_ADDR . $key);
        return ['status' => $response->status(), 'body' => $response->json()];
    }

    private function parsingMessage($message) {
        # Получаем идентификатор чата пользователя
        $idUser = $message['result']['from']['id'];

        # Получаем текст который прислал пользователь
        $command = $message['message']['text'];

        # Узнаем, является данный текст командой
        if(!isset($message['message']['entities'])) return [];

        # Вырезаем команду
        # Получается у нас может быть ситуация, что передастся много команд.
        # Сделаем возможность единоразово обрабатывать все команды.
        $command = [];
        foreach ($message['message']['entities'] as $item)
            $command = mb_substr($command, $item['offset'], $item['length']);
        # Получаем все команды из нашего списка
        $commands = TelegramCommand::whereIn('command', $command)->get();

        # Если нет такой команды ответа не будет
        if(!$commands) return [];

        $textContent = '';
        foreach ($commands as $item)
            $textContent .= $item->context;

        return ['chat_id' => $idUser, 'text' => $commands->context];
    }

    private function sendMessage($key, $messages) {
        foreach ($messages as $item) {
            $responce = Http::post(self::TELEGRAM_ADDR . $key . '/sendMessage', $item);
            # После каждого сообщения даем возможность отдохнуть запросу на 300 миллисекунд
            usleep(300);
        }
    }
}
