<?php

namespace App\Exceptions;

use Exception;

class WorkerException extends Exception
{
    public static function notFound(): self
    {
        return new self('Исполнитель не найден');
    }

    public static function wrongStatus(): self
    {
        return new self('Назначить работника можно только на созданный заказ');
    }
}
