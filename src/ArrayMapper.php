<?php
namespace ResourceAnalyze;

use Nextras\Orm;


class ArrayMapper extends Orm\Mapper\Memory\ArrayMapper {

	protected $aData = [];
	
	/**
	 * Reads stored data
	 * @phpstan-return array{
	 *      0?: array<int|string, mixed>,
	 *      1?: array<string, array<int|string, mixed>>
	 * }
	 */
	protected function readData(): array {
		return $this->aData;

	}

	/**
	 * Stores data
	 * @phpstan-param array{
	 *      array<int|string, mixed>,
	 *      array<string, array<int|string, mixed>>
	 * } $data
	 */
	protected function saveData(array $data): void {
		$this->aData = $data;
	}
}