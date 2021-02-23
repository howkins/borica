# borica




```
src
    Utils
        ParameterBag.php
    Requests
        Request.php
        SaleRequest.php
    Responses
        Response.php
        SaleResponse.php
    Constants
        TransactionType.php
        Action.php
        Url.php
```

## Sale request example

```php
<?php

$borica = new Borica();
$borica->setPrivateKey('');
$borica->setPrivateKeyPassword('');
$borica->setSandbox(true);

$saleRequest = new SaleRequest();
$saleRequest->setOrder();
$saleRequest->setTerminal();
$saleRequest->sign($borica);

$saleRequest->renderForm($borica); //or
$saleRequest->sendRequest($borica); //or

...


// $parameters = new ParameterBag(['AD.CUST_BOR_ORDER_ID' => 'value', 'TRAN_TRTYPE']);
// $parameters->get('AD.CUST_BOR_ORDER_ID')
```

## Sale response example

```php

$borica = new Borica();
$borica->setCertificate('');
$borica->setSandbox(true);

$saleResponse = new SaleResponse($_POST);
$response->verify($borica);
$response->isSuccessful();
$response->isVerified;
```
