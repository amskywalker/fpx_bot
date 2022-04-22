<?php
namespace Src\Championship;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Http\Exceptions\NoPermissionsException;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use React\Promise\ExtendedPromiseInterface;

class Game
{
    public function monitoring(Discord $discord)
    {
        $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
            if (!str_contains($message?->channel?->name, "game")){
                return;
            }
            $commands = [
                "!start" => "start"
            ];

           if (!array_key_exists($message->content, $commands)){
               return;
           }
           $func = $commands[$message->content];
           return $this->$func($message);
        });
    }

    /**
     * @throws NoPermissionsException
     */
    public function start(Message $message): ExtendedPromiseInterface
    {
        $channel = $message->channel;

        $response_message = MessageBuilder::new()
            ->setContent('PARTIDA INICIADA...'. PHP_EOL . "FAVOR INFORMAR SUAS POSIÇÕES COM O COMANDO !iplayin");

        return $channel->sendMessage($response_message);
    }
}