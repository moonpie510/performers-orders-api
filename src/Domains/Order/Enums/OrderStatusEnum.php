<?php

namespace Domains\Order\Enums;

enum OrderStatusEnum: string
{
    case Created = 'Создан';
    case Appointed = 'Назначен исполнитель';
    case Completed = 'Завершен';
}
