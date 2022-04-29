<?php

namespace App\Gaming;

use App\Services\NotificationService;
use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Thread\Thread;
use JetBrains\PhpStorm\ArrayShape;

class Championship
{
    protected Discord $discord;

    public function __construct(Discord $discord)
    {
        $this->discord = $discord;
    }

    public function run(string $name, Channel|Thread|null $channel)
    {
        $notification = new NotificationService($this->discord);
        $player = new Player();
        $players = $player->all($this->discord);
        if(count($players) < 10){
            return $notification->send($this->dont_have_suficient_players(), $channel);
        }
        $notification->send($this->create_info($name, $channel), $channel);
        $notification->send($this->players_info(), $channel);
        $notification->send($this->generating_teams_info(), $channel);
    }

    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public function create_info(string $name, Channel|Thread|null $channel): array
    {
        return [
            "type" => "rich",
            "title" => $name,
            "description" => "Um novo torneio foi iniciado e começara em breve",
            "color" => 16451840,
        ];
    }

    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public function players_info(): array
    {
        $player = new Player();
        $players = $player->all($this->discord);
        return $player->embedInfoPlayers($players);
    }

    #[ArrayShape(["type" => "string", "title" => "", "description" => "string", "color" => "int"])]
    public function generating_teams_info(): array
    {
        return [
            "type" => "rich",
            "title" => "Calmaê",
            "description" => "Estou gerando os times...🙄",
            "color" => 16451840,
        ];
    }

    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public function dont_have_suficient_players(): array
    {
        return [
            "type" => "rich",
            "title" => "Putss!",
            "description" => "Não tem jogador suficiente pra montar os times 😥",
            "color" => 16451840,
        ];
    }
}