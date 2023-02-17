<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
use Nextras\Orm\Relationships as Rels;


/**
 * @property int               $id {primary}
 * @property string            $handle
 * @property string|null       $name
 * @property Layer|null        $oLayer {m:1 Layer::$aEntity}
 * @property Rels\OneHasMany<Relation> $aFrom {1:m Relation::$oFrom}
 * @property Rels\OneHasMany<Relation> $aTo {1:m Relation::$oTo}
 * @property int|null          $income
 * @property int|null          $costs
 */
class Entity extends Orm\Entity\Entity {

	
}