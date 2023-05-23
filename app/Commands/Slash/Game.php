<?php

namespace App\Commands\Slash;

use App\Notifications\GameNotification;
use App\Responses\ErrorResponse;
use App\Services\Notificator\NotificationService;
use Discord\Parts\Interactions\Command\Option;
use Discord\Repository\Interaction\OptionRepository;
use Discord\Parts\Interactions\Interaction;
use Exception;
use React\Promise\ExtendedPromiseInterface;

class Game extends Slash
{
    protected string $name = "game";
    protected string $description = "Inicia um novo torneio";
    protected array $options = [
        [
            "name" => "nome",
            "description" => "Descreva o nome do torneio",
            "required" => true,
            "type" => Option::STRING,
        ], [
            "name" => "modo",
            "description" => "Descreva o nome do torneio",
            "required" => true,
            "choices" => [
                [
                    "name" => "1v1",
                    "value" => "1v1"
                ], [
                    "name" => "2v2",
                    "value" => "2v2"
                ], [
                    "name" => "3v3",
                    "value" => "3v3"
                ], [
                    "name" => "4v4",
                    "value" => "4v4"
                ], [
                    "name" => "5v5",
                    "value" => "5v5"
                ],
            ],
            "type" => Option::STRING
        ]
    ];

    public function __construct(Interaction $interaction)
    {
        try {
            parent::__construct();
            $this->run($interaction->data->options, $interaction);
        } catch (Exception $exception) {
            $errorResponse = ErrorResponse::definition();
            $interaction->respondWithMessage($this->responseService->run($errorResponse));
        }
    }

    /**
     * @throws Exception
     */
    public function run(OptionRepository $options, Interaction $interaction): ExtendedPromiseInterface
    {
        $name = $options->get('name', 'nome');
        $mode = $options->get('name', 'modo');
        $data['name'] = $name->value;
        $data['mode'] = $mode->value;
        NotificationService::send($this->discord, GameNotification::start($data));
        return $this->response($interaction);
    }
}