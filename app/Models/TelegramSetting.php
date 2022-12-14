<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramSetting extends Model
{
    use HasFactory;

    /**
     *
     * Защита колонки id для изменения
     *
     * @var string[]
     */
    protected $guarded = ['id'];
}
