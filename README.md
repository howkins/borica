# Borica EMV 3DS

## Installation

```shell
composer require howkins/borica
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
$saleRequest->setMInfo(base64_encode('{"email":"g.zhelezov@pensoft.net","cardholderName":"Georgi Zhelezov"}'));
$saleRequest->setAdCustomBoricaOrderId($saleRequest->getOrder().' '.$saleRequest->getMerchant());
$saleRequest->setTimestamp(time());
$saleRequest->sign($borica);

if($saleRequest->validate()){
    foreach($saleRequest->getErrors() as $error){
        print $error."\n";
    }
    exit;
}

echo $saleRequest->renderForm($borica);

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
