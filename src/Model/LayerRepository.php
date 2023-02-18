<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;


class LayerRepository extends Orm\Repository\Repository {
	
	static function getEntityClassNames(): array {
		return [Layer::class];
	}
}