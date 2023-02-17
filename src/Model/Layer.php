<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
use Nextras\Orm\Relationships\ManyHasOne;


/**
 * @property int                $id {primary}
 * @property string|null        $name
 * @property OneHasMany<Entity> $aEntity {1:m Entity::$oLayer}
 * @property int                $order
 */
class Layer extends Orm\Entity\Entity {
}
