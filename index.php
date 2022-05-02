<?php

require "./bootstrap.php";

use App\Commands\Slash\Game;
use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Embed\Embed;
use Discord\Parts\Interactions\Interaction;
use Discord\WebSockets\Event;


try {
    $discord = new Discord([
        'token' => $_ENV['BOT_TOKEN'],
    ]);
    $discord->on('ready', function (Discord $discord) {
        $discord->on(Event::INTERACTION_CREATE, function (Interaction $interaction, Discord $discord) {
            match (true) {
                $interaction->data->name == "game" => new Game($interaction, $interaction->data->options, $discord) ,
                default => $interaction->respondWithMessage(MessageBuilder::new()
                    ->setEmbeds(
                        [
                            new Embed($discord, [
                                "type" => "rich",
                                "title" => "Foi maal 😥",
                                "description" => "algo de errado não está certo!",
                                "color" => 16451840,
                            ])
                        ]
                    )
                )
            };
        });
    });
    $discord->run();
} catch (IntentException $e) {
}

