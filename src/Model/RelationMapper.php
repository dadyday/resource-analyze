<?php
namespace ResourceAnalyze\Model;

use Nextras\Orm;
use Nextras\Orm\Mapper\Dbal\Conventions\IConventions;


class RelationMapper extends Orm\Mapper\Mapper {
	
	protected function createConventions(): IConventions {
		$conventions = parent::createConventions();
		$conventions->setMapping('oFrom', 'from_id');
		$conventions->setMapping('oTo', 'to_id');
		return $conventions;
	}

	function renderIncome() {
		$sql = file_get_contents(__DIR__.'/renderIncome.sql');
		$aSql = preg_split('~;[ ]*(\n+\s*|$)~', $sql, -1, PREG_SPLIT_NO_EMPTY);
		#dump($aSql);
		foreach ($aSql as $sql) {
			$this->connection->query($sql);
		}
		
		$i = 5;
		do {
			$this->connection->query($sql);
			$n = $this->connection->getAffectedRows();
		}
		while ($n || !$i--);
	}

	function renderCosts() {
		$sql = file_get_contents(__DIR__.'/renderCosts.sql');
		$aSql = preg_split('~;[ ]*(\n+\s*|$)~', $sql, -1, PREG_SPLIT_NO_EMPTY);
		#dump($aSql);
		foreach ($aSql as $sql) {
			$this->connection->query($sql);
		}
		
		$i = 5;
		do {
			$this->connection->query($sql);
			$n = $this->connection->getAffectedRows();
		}
		while ($n || !$i--);
	}

}
