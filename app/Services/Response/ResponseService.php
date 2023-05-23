<?php

namespace App\Services\Response;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Embed\Embed;
use Exception;
use Monolog\Logger;

class ResponseService
{
    /**
     * @throws Exception
     */
    public function run(array $data): MessageBuilder
    {
        try {
            $discord = new Discord([
                'token' => $_ENV['BOT_TOKEN'],
                'logger' => new Logger('New logger'),
            ]);

            return MessageBuilder::new()
                ->setEmbeds([new Embed($discord, $data)]);
        } catch (IntentException $e) {
            throw new Exception($e->getMessage());
        }
    }
}