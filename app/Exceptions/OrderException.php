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

    public static function wrongStatusForUpdate(): self
    {
        return new self('Статус заказа не может быть изменен');
    }

    public static function cantChangeStatusTo(string $currentStatus, string $newStatus): self
    {
        return new self("Невозможно изменить статус с {$currentStatus} на {$newStatus}");
    }

    public static function excludedType(): self
    {
        return new self('Работник отказался от заказов с таким статусом');
    }
}
