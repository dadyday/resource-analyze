<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
#use Nextras\Orm\Relationships\ManyHasOne;


/**
 * @property int               $id {primary}
 * @property Entity            $oFrom {m:1 Entity::$aFrom}
 * @property Entity            $oTo {m:1 Entity::$aTo}
 * @property double            $value
 * @property double            $incomePart
 * @property double            $costsPart
 */
class Relation extends Orm\Entity\Entity {

	
}