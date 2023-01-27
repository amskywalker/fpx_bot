<?php

namespace App\Commands\Slash;

use App\Notifications\GameNotification;
use App\Responses\ErrorResponse;
use App\Responses\SuccesfullResponse;
use App\Services\Notificator\NotificationService;
use App\Services\Response\ResponserService;
use Discord\Discord;
use Discord\Parts\Interactions\Request\Option;
use Discord\Repository\Interaction\OptionRepository;
use Discord\Slash\Parts\Command;
use Discord\Parts\Interactions\Interaction;
use React\Promise\ExtendedPromiseInterface;

class Game extends Slash
{
    protected Discord $discord;

    public function __construct(Interaction $interaction, OptionRepository $options, Discord $discord)
    {
        try {
            parent::__construct();
            $this->discord = $discord;
            $this->info($options->get('name', 'name'), $interaction);
        } catch (\Exception $exception) {
            $errorResponse = ErrorResponse::definition();
            $interaction->respondWithMessage(ResponserService::run($this->discord, $errorResponse));
        }
    }

    public function addToDiscord(string $name, string $description, array $options = []): Command
    {
        return $this->client->createGlobalCommand($name, $description, $options);
    }

    public function info(Option $name, Interaction $interaction): ExtendedPromiseInterface
    {
        $response = SuccesfullResponse::definition();
        NotificationService::send($this->discord, GameNotification::start($name->value));
        return $interaction->respondWithMessage(ResponserService::run($this->discord, $response));
    }
}