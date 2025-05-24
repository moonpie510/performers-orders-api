<?php

namespace Domains\Order\Enums;

enum OrderTypeEnum: string
{
    case Loading = 'Погрузка/Разгрузка';
    case Rigging = 'Такелажные работы';
    case Cleaning = 'Уборка';
}
