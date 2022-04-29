<?php

namespace App\Gaming;

use Discord\Discord;
use Discord\Helpers\Collection;
use JetBrains\PhpStorm\ArrayShape;

class Player
{
    public function all(Discord $discord): Collection
    {
        $channel = $discord->getChannel($_ENV['SAGUAO_CHANNEL_ID']);
        return $channel->members->filter(function ($item) {
            return $item->member->roles->filter(function ($role) {
                    return in_array($role->name, ["TOP", "JG", "MID", "ADC", "SUP"]);
                })->count() > 0;
        });
    }

    public function groupPlayersByPosition(Collection $players, string $position): Collection
    {
        return $players->filter(function ($item) use ($position) {
            return $item->member->roles->filter(function ($role) use ($position) {
                    return $role->name == $position;
                })->count() > 0;
        })->map(function ($item) {
            return $item->member->nick;
        });
    }

    #[ArrayShape(["type" => "string", "title" => "string", "description" => "string", "color" => "int"])]
    public function embedInfoPlayers(Collection $players): array
    {
        $description = "TOP LANERS \n";
        $description .= implode("\n",$this->groupPlayersByPosition($players, "TOP")->toArray());

        $description .= "\n \n JUNGLERS \n";
        $description .= implode("\n",$this->groupPlayersByPosition($players, "JG")->toArray());

        $description .= "\n \n MID LANERS \n";
        $description .= implode("\n",$this->groupPlayersByPosition($players, "MIND")->toArray());

        $description .= "\n \n AD CARRIES \n";
        $description .= implode("\n",$this->groupPlayersByPosition($players, "ADC")->toArray());

        $description .= "\n \n SUPPORTS \n";
        $description .= implode("\n",$this->groupPlayersByPosition($players, "SUP")->toArray());

        return [
            "type" => "rich",
            "title" => "Lista de jogadores",
            "description" => $description,
            "color" => 16451840,
        ];
    }
}