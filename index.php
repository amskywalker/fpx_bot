<?php

require "./bootstrap.php";

use App\Commands\Slash\Game;
use App\Responses\DefaultResponse;
use App\Services\Response\ResponseService;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Interactions\Interaction;
use Discord\Slash\RegisterClient;
use Discord\WebSockets\Event;
use Monolog\Logger;


try {
    $discord = new Discord([
        'token' => $_ENV['BOT_TOKEN'],
        'logger' => new Logger('New logger'),
    ]);

    $client = new RegisterClient($_ENV['BOT_TOKEN']);
    $discord->on('ready', function (Discord $discord) {
        $discord->on(Event::INTERACTION_CREATE, function (Interaction $interaction, Discord $discord) {
            match (true) {
                $interaction->data->name == "game" => new Game($interaction, $discord),
                default => $interaction->respondWithMessage((new ResponseService)->run(DefaultResponse::definition()))
            };
        });
    });
    $discord->run();
} catch (IntentException|GuzzleHttp\Exception\ClientException|ArgumentCountError $e) {
    var_dump($e->getMessage());
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}

