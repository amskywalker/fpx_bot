<?php

namespace App\Notifications;

use JetBrains\PhpStorm\ArrayShape;

class GameNotification
{
    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public static function start(array $data): array
    {
        return [
            "type" => "rich",
            "title" => $data['name'],
            "description" => "O torneio foi {$data['mode']} iniciado ⚔️",
            "color" => 16451840,
        ];
    }
}