<?php

require 'vendor/autoload.php';

$eCardService = new Org\DLPU\ECard\Service\ECardService();

var_dump($eCardService->getBalance('1405040222'));
var_dump($eCardService->getConsumption('1405040222'));
