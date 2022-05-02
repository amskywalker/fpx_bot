<?php

namespace App\Notifications;

use JetBrains\PhpStorm\ArrayShape;

class GameNotification
{
    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public static function start(string $name): array
    {
        return [
            "type" => "rich",
            "title" => $name,
            "description" => "O torneio foi iniciado ⚔️",
            "color" => 16451840,
        ];
    }
}