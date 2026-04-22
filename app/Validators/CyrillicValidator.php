<?php

namespace Validators;

class CyrillicValidator
{    protected string $message = 'Поле должно содержать только кириллицу, пробелы и дефисы';

    public function handle($value): bool
    {
        return (bool) preg_match('/^[\p{Cyrillic}\s-]{1,255}$/u', $value);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}