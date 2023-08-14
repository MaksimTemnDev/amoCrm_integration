<?php
//установим подключение к amoCrm
use AmoCRM\Client\AmoCRMApiClient;
use Symfony\Component\Dotenv\Dotenv;

include_once '../vendor/autoload.php';

//проверка наличия токена
if (!isset($_GET['code'])) {
    exit('INVALID REQUEST');
}

$dotenv = new Dotenv;
$dotenv->load('../.env');

$apiClient = new AmoCRMApiClient(
    $_ENV['CLIENT_ID'],
    $_ENV['CLIENT_SECRET'],
    $_ENV['CLIENT_REDIRECT_URI']
);
$apiClient->setAccountBaseDomain($_ENV['ACCOUNT_DOMAIN']);

$token = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

//запишем полученный токен в файл
file_put_contents('../token.json', json_encode($token->jsonSerialize(), JSON_PRETTY_PRINT));

echo 'OK';