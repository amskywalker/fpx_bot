<?php
namespace App\Commands\Slash;

use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Slash\RegisterClient;

class Slash
{
    protected RegisterClient $client;
    protected Discord $discord;

    /**
     * @throws IntentException
     */
    public function __construct()
    {
        $this->discord = new Discord([
            'token' => $_ENV['BOT_TOKEN'],
        ]);
        $this->client = new RegisterClient($_ENV['BOT_TOKEN']);
    }
}