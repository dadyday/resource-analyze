<?php
require_once __DIR__.'/../vendor/autoload.php';

$oConfig = App\Bootstrap::boot();
$oDi = $oConfig->createContainer();

$oSankey = $oDi->getByType(ResourceAnalyze\SankeyData::class);
$oSankey->build();
$oSankey->printJsonData();

/*
$oModel = $oDi->getByType(Nextras\Orm\Model\IModel::class);

*/
