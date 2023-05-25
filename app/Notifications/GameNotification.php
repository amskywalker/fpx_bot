<?php

namespace App\Notifications;

use Discord\Repository\Interaction\OptionRepository;
use JetBrains\PhpStorm\ArrayShape;

class GameNotification
{
    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public static function start(OptionRepository $options): array
    {
        $name = $options->get('name', 'nome');
        $mode = $options->get('name', 'modo');
        return [
            "type" => "rich",
            "title" => $name->value,
            "description" => "O torneio foi {$mode->value} iniciado ⚔️",
            "color" => 16451840,
        ];
    }
}