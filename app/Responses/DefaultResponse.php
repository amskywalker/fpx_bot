<?php

namespace App\Responses;

use JetBrains\PhpStorm\ArrayShape;

class DefaultResponse
{
    #[ArrayShape(["type" => "string", "title" => "", "description" => "string", "color" => "int"])]
    public static function definition(): array
    {
        return [
            "type" => "rich",
            "title" => "Foi maal 😥",
            "description" => "algo de errado não está certo!",
            "color" => 16451840,
        ];
    }
}