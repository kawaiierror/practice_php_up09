<?php

namespace Validators;

class YearValidator
{
    protected string $message = 'Год должен состоять из цифр (максимум 4)';

    public function handle($value): bool
    {
        return (bool) preg_match('/^\d{1,4}$/', $value);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}