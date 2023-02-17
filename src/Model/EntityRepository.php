<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;

class EntityRepository extends Orm\Repository\Repository {
    
    static function getEntityClassNames(): array {
        return [Entity::class];
    }

    /**
     * @return Orm\Collection\ICollection|Model\Entity[]
     */
    public function findLatest()
    {
        return $this->findAll()->orderBy('id', Orm\Collection\ICollection::DESC)->limitBy(3);
    }

}