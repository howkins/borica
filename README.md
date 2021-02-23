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
$borica->setPrivateKey('/var/www/certificates/borica.pem');
$borica->setPrivateKeyPassword('');
$borica->setSandbox(true);

$saleRequest = new SaleRequest();

$saleRequest->setTerminal('V5400560');
$saleRequest->setAmount(100);
// $saleRequest->setCurrency('BGN');
$saleRequest->setOrder(1);
$saleRequest->setDescription('Order products');
$saleRequest->setMerchant('6210005412');
$saleRequest->setMerchantName('pensoft.net');
$saleRequest->setEmail('g.zhelezov@pensoft.net');
// $saleRequest->setCountry('BG');
// $saleRequest->setMerchantGmt('+02');
// $saleRequest->setAddendum('AD,TD');
$saleRequest->setAdCustomBoricaOrderId($saleRequest->getOrder().' '.$saleRequest->getMerchant());
$saleRequest->setTimestamp(time());
$saleRequest->sign($borica);

if($saleRequest->validate()){
    foreach(SaleRequest->getErrors() as $error){
        print $error."\n";
    }
    exit;
}

$saleRequest->renderForm($borica);
...


// $parameters = new ParameterBag(['AD.CUST_BOR_ORDER_ID' => 'value', 'TRAN_TRTYPE']);
// $parameters->get('AD.CUST_BOR_ORDER_ID')
```

## Sale response example

```php
$borica = new Borica();
$borica->setCertificate('/var/www/certificates/borica.cer');
$borica->setSandbox(true);

$response = new Response($_POST);
$response->verify($borica);

if(!$response->isVerified){
    print "Is not verified"; 
    exit;
}

if($response->isSuccessful()){
    print "Response code is successful";
    exit;
}

```
