<?php

namespace App\Gaming;

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
    public function main(Discord $discord)
    {
        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
            if (!str_contains($message?->channel?->name, "game")) {
                return;
            }
            $championship = new Championship($discord);
            match (true) {
                str_contains($message->content, "!championship") => $championship->create(str_replace("!championship", "", $message->content), $message->channel),
                default => ""
            };
        });
    }
}