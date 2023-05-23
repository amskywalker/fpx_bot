<?php

namespace App\Responses;

use JetBrains\PhpStorm\ArrayShape;

class SuccessfulResponse
{
    #[ArrayShape(["type" => "string", "title" => "", "description" => "string", "color" => "int"])]
    public static function definition(): array
    {
        return [
            "type" => "rich",
            "title" => "Deu bom 😋",
            "description" => "Comando executado com sucesso",
            "color" => 16451840,
        ];
    }
}