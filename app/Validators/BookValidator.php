<?php

namespace Validators;

class BookValidator
{
    protected string $message = 'Поле содержит недопустимые символы. Разрешена только кириллица, цифры и знаки препинания.';

    public function handle($value): bool
    {
        $pattern = '/^[\p{Cyrillic}0-9\s\.,:;\-\"\'«»\(\)]{1,255}$/u';

        return (bool) preg_match($pattern, $value);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}