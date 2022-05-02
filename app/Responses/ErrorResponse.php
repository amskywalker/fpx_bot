<?php

namespace App\Responses;

use JetBrains\PhpStorm\ArrayShape;

class ErrorResponse
{
    #[ArrayShape(["type" => "string", "title" => "", "description" => "string", "color" => "int"])]
    public static function definition(): array
    {
        return [
            "type" => "rich",
            "title" => "Deu ruim 😣",
            "description" => "Comando não foi executado",
            "color" => 131845,
        ];
    }
}