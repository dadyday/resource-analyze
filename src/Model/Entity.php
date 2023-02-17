<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
#use Nextras\Orm\Relationships\ManyHasOne;


/**
 * @property int               $id {primary}
 * @property string            $handle
 * @property string|null       $name
 * @property Layer|null        $oLayer {m:1 Layer::$aEntity}
 * @property OneHasMany<Relation> $aFrom {1:m Relation::$oFrom}
 * @property OneHasMany<Relation> $aTo {1:m Relation::$oTo}
 * @property int|null          $income
 * @property int|null          $costs
 */
class Entity extends Orm\Entity\Entity {

	
}