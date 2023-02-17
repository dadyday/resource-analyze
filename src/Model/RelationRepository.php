<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;

/**
 * @method void renderIncome()
 * @method void renderCosts()
 */
class RelationRepository extends Orm\Repository\Repository {
    
    static function getEntityClassNames(): array {
        return [Relation::class];
    }

    /**
     * @return Orm\Collection\ICollection|Layer[]
     */
    public function findLayerPairs() {
        $oSql = $this->builder()
            ->where('id % 2 = 0')
        ;
        return $this->toCollection($oSql);
    }
}