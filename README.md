# FPXBOT

This is a discord bot used to manage a discord community. The community has a study tab, a games tab and a tournament tab.


### Como adicionar um comando:

```php
use Discord\Slash\RegisterClient;

$client = new RegisterClient($_ENV['BOT_TOKEN']);

$client->createGlobalCommand("name-command", "description-command", [
    [
    "name" => "option-name",
    "description" => "option-description",
    "type" => \Discord\Parts\Interactions\Command\Option::STRING //type option
    ]
]);
```
