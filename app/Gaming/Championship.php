<?php

namespace App\Gaming;

use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Thread\Thread;
use React\Promise\ExtendedPromiseInterface;

class Championship
{
    protected Discord $discord;

    public function __construct(Discord $discord)
    {
        $this->discord = $discord;
    }

    public function create(string $name, Channel|Thread|null $channel): ExtendedPromiseInterface
    {
        $embed = new Embed($this->discord, [
            "type" => "rich",
            "title" => $name,
            "description" => "Um novo torneio foi iniciado e começara em breve",
            "color" => 16451840,
        ]);
        return $channel->sendEmbed($embed);
    }
}