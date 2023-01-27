<?php

namespace App\Services\Response;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Embed\Embed;

class ResponserService
{
    public static function run(Discord $discord, array $data): MessageBuilder
    {
        return MessageBuilder::new()
            ->setEmbeds([new Embed($discord, $data)]);
    }
}