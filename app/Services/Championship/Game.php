<?php

namespace App\Services\Championship;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Helpers\Collection;
use Discord\Http\Exceptions\NoPermissionsException;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\WebSockets\Event;
use JetBrains\PhpStorm\ArrayShape;
use React\Promise\ExtendedPromiseInterface;

class Game
{
    public function monitoring(Discord $discord)
    {
        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
            if (!str_contains($message?->channel?->name, "game")) {
                return;
            }

            match (true) {
                str_contains($message->content, "!championship") => $this->championship($discord, $message),
                default => ""
            };
        });
    }


    public function championship(Discord $discord, Message $message): ExtendedPromiseInterface
    {
        $channel = $message->channel;
        $command = "!championship";
        $name = str_replace($command, '', $message->content);

        $embed = [
            "type" => "rich",
            "title" => $name,
            "description" => "Um novo torneio foi iniciado e começara em breve",
            "color" => 16451840,
        ];
        $embed = new Embed($discord, $embed);
        return $channel->sendEmbed($embed);
    }
}