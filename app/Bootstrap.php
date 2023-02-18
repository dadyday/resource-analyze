<?php
namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap {
	
	public static function boot(): Configurator
	{
		$appDir = dirname(__DIR__);
		$configurator = new Configurator;
		#$configurator->setDebugMode('secret@23.75.345.200');
		$configurator->enableTracy($appDir . '/log');
		$configurator->setTempDirectory($appDir . '/temp');
		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
		#	->addDirectory($appDir . '/src')
			->register();
		$configurator->addConfig($appDir . '/app/common.neon');
		return $configurator;
	}
}
