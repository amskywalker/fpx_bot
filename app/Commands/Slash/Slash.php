<?php
namespace App\Commands\Slash;

use Discord\Exceptions\IntentException;
use Discord\Slash\RegisterClient;

class Slash
{
    protected RegisterClient $client;

    /**
     * @throws IntentException
     */
    public function __construct()
    {
        $this->client = new RegisterClient($_ENV['BOT_TOKEN']);
    }
}