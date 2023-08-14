<?php

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\CustomFieldsValues\NumericCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\NumericCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\NumericCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Collections\ContactsCollection;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\Dotenv\Dotenv;

include '../vendor/autoload.php';

$dotenv = new Dotenv;
$dotenv->load('../.env');

$apiClient = new AmoCRMApiClient(
    $_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET'], $_ENV['CLIENT_REDIRECT_URI']
);

$apiClient->setAccountBaseDomain($_ENV['ACCOUNT_DOMAIN']);

$rawToken = json_decode(file_get_contents('../token.json'), 1);
$token = new AccessToken($rawToken);

$apiClient->setAccessToken($token);

class Lead
{
    //добавление в аккаунт
    function add($name, $email, $phone, $price)
    {
        $apiClient = new AmoCRMApiClient(
            $_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET'], $_ENV['CLIENT_REDIRECT_URI']
        );

        $apiClient->setAccountBaseDomain($_ENV['ACCOUNT_DOMAIN']);

        $rawToken = json_decode(file_get_contents('../token.json'), 1);
        $token = new AccessToken($rawToken);

        $apiClient->setAccessToken($token);

        $lead = (new LeadModel)->setName("Новая сделка {$name}")->setContacts((new ContactsCollection)->add((new ContactModel)->setAccountId("74257367")->setName("standart contract")))
            ->setPrice($price)->setCustomFieldsValues(
                (new CustomFieldsValuesCollection)->add(
                    (new TextCustomFieldValuesModel)->setFieldId(
                        $_ENV['NAME_FIELD_ID']
                    )->setValues(
                            (new TextCustomFieldValueCollection)->add(
                                (new TextCustomFieldValueModel)->setValue(
                                    $name
                                )
                            )
                        )
                )->add(
                        (new TextCustomFieldValuesModel)->setFieldId(
                            $_ENV['EMAIL_FIELD_ID']
                        )->setValues(
                                (new TextCustomFieldValueCollection)->add(
                                    (new TextCustomFieldValueModel)->setValue(
                                        $email
                                    )
                                )
                            )
                    )->add(
                        (new TextCustomFieldValuesModel)->setFieldId(
                            $_ENV['PHONE_FIELD_ID']
                        )->setValues(
                                (new TextCustomFieldValueCollection)->add(
                                    (new TextCustomFieldValueModel)->setValue(
                                        $phone
                                    )
                                )
                            )
                    )->add(
                        (new TextCustomFieldValuesModel)->setFieldId(
                            $_ENV['PRICE_FIELD_ID']
                        )->setValues(
                                (new TextCustomFieldValueCollection)->add(
                                    (new TextCustomFieldValueModel)->setValue(
                                        $price
                                    )
                                )
                            )
                    )
            );

        $lead = $apiClient->leads()->addOne($lead);

        echo "OK. LEAD_ID: {$lead->getId()}";
    }
}
