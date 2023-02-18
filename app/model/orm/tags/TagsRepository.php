<?php

namespace OrmDemo;

use Nextras\Orm\Repository\Repository;


/**
 * @method Tag|NULL getById($id)
 */
class TagsRepository extends Repository
{
	static function getEntityClassNames(): array
	{
		return [Tag::class];
	}
}
