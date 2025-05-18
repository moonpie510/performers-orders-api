<?php

namespace App\Exceptions;

use Exception;

class OrderException extends Exception
{
    public static function notFound(): self
    {
        return new self('Заказ не найден');
    }

    public static function wrongStatus(): self
    {
        return new self('Назначить работника можно только на созданный заказ');
    }

    public static function excludedType(): self
    {
        return new self('Работник отказался от заказов с таким статусом');
    }
}
