<?php

namespace Validators;

class ImageValidator
{
    protected string $message = '';
    protected array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
    protected int $maxSize = 5 * 1024 * 1024;

    public function handle(array $file): bool
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->message = 'Ошибка при загрузке файла.';
            return false;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            $this->message = 'Недопустимый формат Разрешены: JPG, PNG, WebP, SVG.';
            return false;
        }

        if ($file['size'] > $this->maxSize) {
            $this->message = 'Файл слишком большой Максимум 5Мб.';
            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
