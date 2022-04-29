<?php

namespace App\Services;

use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Thread\Thread;

class NotificationService
{
    protected Discord $discord;

    public function __construct(Discord $discord)
    {
        $this->discord = $discord;
    }

    public function send(array $attributes, Channel|Thread|null $channel): \React\Promise\ExtendedPromiseInterface
    {
        $embed = new Embed($this->discord, $attributes);
        return $channel->sendEmbed($embed);
    }
}