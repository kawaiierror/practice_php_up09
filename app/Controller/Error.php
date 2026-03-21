<?php

namespace Controller;

use Src\View;

class Error
{
    public function error403(): string
    {
        return new View('errors.error403');
    }

}
