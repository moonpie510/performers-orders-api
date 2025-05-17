<?php

namespace App\Exceptions;

use Exception;

class AuthException extends Exception
{
    public static function wrongCredentials(): self
    {
        return new self('Неверный email или пароль');
    }

    public static function notAuthorized(): self
    {
        return new self('Вы не авторизованы');
    }

    public static function sessionNotFound(): self
    {
        return new self('Сессия не найдена');
    }
}
