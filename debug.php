<?php

require 'vendor/autoload.php';

$dlpuEcard = new Cn\Xu42\DlpuEcard\Service\DlpuEcardService();

var_dump($dlpuEcard->getBalance('1305040333'));
var_dump($dlpuEcard->getConsumption('1305040333'));
