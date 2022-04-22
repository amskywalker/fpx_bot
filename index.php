<?php

include __DIR__ . '/vendor/autoload.php';

use Discord\Discord;
use Discord\Exceptions\IntentException;
use Src\Championship\Game;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

try {
    $game = new Game();
    $discord = new Discord([
        'token' => $_ENV['BOT_TOKEN'],
    ]);
    $discord->on('ready', function (Discord $discord) use ($game) {
        $game->monitoring($discord);
    });
    $discord->run();
} catch (IntentException $e) {
}

