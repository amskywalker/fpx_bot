<?php

namespace App\Services\Notificator;

use Discord\Discord;
use Discord\Parts\Embed\Embed;
use React\Promise\ExtendedPromiseInterface;

class NotificationService
{

    public static function send(Discord $discord, array $data): ?ExtendedPromiseInterface
    {
        $embed = new Embed($discord, $data);
        return $discord->getChannel($_ENV['MAIN_CHANNEL_ID'])?->sendEmbed($embed);
    }
}