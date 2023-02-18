<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
use Nextras\Orm\Mapper\Dbal\Conventions\IConventions;


class EntityMapper extends Orm\Mapper\Mapper {
	
	protected function createConventions(): IConventions {
		$conventions = parent::createConventions();
		$conventions->setMapping('oLayer', 'layer_id');
		return $conventions;
	}

}
