<?php

require "./bootstrap.php";

use Discord\Discord;
use Discord\Exceptions\IntentException;
use App\Services\Championship\Game;


try {
    $game = new Game();
    $discord = new Discord([
        'token' => $_ENV['BOT_TOKEN'],
    ]);
    $discord->on('ready', function (Discord $discord) use ($game) {
        $game->main($discord);
    });
    $discord->run();
} catch (IntentException $e) {
}

