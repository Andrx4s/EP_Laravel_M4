<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции для создания таблицы telegram_settings
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название колонки настройки');
            $table->string('val')->comment('Здесь будут значения настроек');
            $table->timestamps();
        });
    }

    /**
     * Отмена миграции
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_settings');
    }
};
