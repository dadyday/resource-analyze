<?php
require_once __DIR__.'/../vendor/autoload.php';

$oConfig = App\Bootstrap::boot();
$oDi = $oConfig->createContainer();

$mode = $_GET['mode'] ?? null;

$oSankey = $oDi->getByType(ResourceAnalyze\SankeyData::class);
$oSankey->build($mode);
$oSankey->printJsonData();

/*
$oModel = $oDi->getByType(Nextras\Orm\Model\IModel::class);

*/
