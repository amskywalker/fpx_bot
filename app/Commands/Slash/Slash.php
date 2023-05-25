<?php
namespace App\Commands\Slash;

use App\Responses\SuccessfulResponse;
use App\Services\Response\ResponseService;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Interactions\Interaction;
use Discord\Slash\Parts\Command;
use Discord\Slash\RegisterClient;
use Exception;
use Monolog\Logger;
use React\Promise\ExtendedPromiseInterface;

class Slash
{
    protected RegisterClient $client;
    protected string $name;
    protected string $description;
    protected array $options = [];

    protected ResponseService $responseService;
    public function __construct()
    {
        $this->client = new RegisterClient($_ENV['BOT_TOKEN']);
        $this->responseService = new ResponseService();
    }
    public function addCommand(): Command
    {
        return $this->client->createGlobalCommand($this->name, $this->description, $this->options);
    }

    /**
     * @throws Exception
     */
    public function response(Interaction $interaction): ExtendedPromiseInterface
    {
        $response = SuccessfulResponse::definition();
        return $interaction->respondWithMessage($this->responseService->run($response));
    }
    
}