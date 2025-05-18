<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Created = 'Создан';
    case Appointed = 'Назначен исполнитель';
    case Completed = 'Завершен';
}
