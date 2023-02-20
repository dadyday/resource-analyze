<?php
namespace ResourceAnalyze;

use Nextras\Orm;


class SankeyData {

	protected
		$oModel,
		$aNode = [
			['key' => "Coal reserves", 'text' => "Coal reserves"],
			['key' => "Coal imports", 'text' => "Coal imports"],
			["key" => "Coal", "text" => "Coal", "color" => "#9d75c2"],
			['key' => "Oil reserves", 'text' => "Oil\nreserves"],
			['key' => "Oil imports", 'text' => "Oil imports"],
			["key" => "Oil", "text" => "Oil", "color" => "#9d75c2"],
		],
		$aLink = [
			["from" => "Coal reserves", "to" => "Coal", "width" => 31],
			["from" => "Coal imports", "to" => "Coal", "width" => 86],
		];

	function __construct(Model $oModel) {
		$this->oModel = $oModel;
	}

	function build() {
		$this->oModel->oRelationRepo->renderIncome();
		$this->oModel->oRelationRepo->renderCosts();
		
		$aLayer = $this->oModel->oLayerRepo->findAll()->orderBy('order', Orm\Collection\ICollection::ASC);
		$oLastLayer = null;
		$aColor = ['#9977cc','#cc4488','#3388bb','#44cc88','#cccc44'];
		$aNode = [];
		$aLinkIncome = [];
		$aLinkCosts = [];
		$aLinkDiffs = [];

		foreach ($aLayer as $i => $oLayer) {
			foreach ($oLayer->aEntity as $oEntity) {

				$aNode[] = [
					'key' => $oEntity->id,
					'text' => $oEntity->name,
					'color' => $aColor[$i] ?? null,
				];
			}
		}

		$aRelation = $this->oModel->oRelationRepo->findAll();
		foreach ($aRelation as $oRelation) {
			$i = round($oRelation->incomePart * $oRelation->oFrom->income);
			$o = round($oRelation->costsPart * $oRelation->oTo->costs);

			$core = min($i, $o);
			$diff = abs($o - $i);
			$color = $i > $o ? '#408040' : '#c04040';

			/*
			$this->aLink[] = [
				'from' => $oRelation->oFrom->id, 
				'to' => $oRelation->oTo->id, 
				'width' => $core,
				'color' => '#8080c0',
			]; //*/


			
			//*
			$aLinkIncome[] = [
				'from' => $oRelation->oFrom->id, 
				'to' => $oRelation->oTo->id, 
				'width' => $core,
				'color' => '#80c080',
			]; //*/
			//*
			$aLinkCosts[] = [
				'from' => $oRelation->oFrom->id, 
				'to' => $oRelation->oTo->id, 
				'width' => $core,
				'color' => '#c08080',
			]; //*/
			$aLinkDiffs[] = [
				'from' => $oRelation->oFrom->id,
				'to' => $oRelation->oTo->id,
				'width' => $diff,
				'color' => $color,
			]; //*/
		}
/*
		foreach ($aLayer as $i => $oLayer) {
			foreach ($oLayer->aEntity as $oEntity) {
				
				$this->aNode[] = [
					'key' => $oEntity->id,
					'text' => $oEntity->name,
					'color' => $aColor[$i] ?? null,
				];

				
				$aRelation = $this->oModel->oRelationRepo->findBy(['oFrom' => $oEntity]);
				foreach ($aRelation as $oRelation) {
					#dump($oRelation);
					$this->aLink[] = [
						'from' => $oEntity->id, 
						'to' => $oRelation->oTo->id, 
						'width' => round($oRelation->incomePart * $oEntity->income /100),
						'color' => '#80c080',
					]; //* /
				}
			}
		}

		foreach ($aLayer as $i => $oLayer) {
			foreach ($oLayer->aEntity as $oEntity) {
				
				$aRelation = $this->oModel->oRelationRepo->findBy(['oTo' => $oEntity]);
				foreach ($aRelation as $oRelation) {
					#dump($oRelation);
					$this->aLink[] = [
						'from' => $oRelation->oFrom->id, 
						'to' => $oEntity->id, 
						'width' => round($oRelation->costsPart * $oEntity->costs /100),
						'color' => '#ff8080',
					]; //* /
				}
				
			}
		}
*/		
		$this->aNode = $aNode;
		$this->aLink = array_merge(
			//$aLinkIncome,
			$aLinkDiffs,
			//$aLinkCosts
		);
	}

	function getData() {
		return [
			"class" => "go.GraphLinksModel",
		  	"nodeDataArray" => $this->aNode, 
			"linkDataArray" => $this->aLink,
		];
	}

	function getJsonData() {
		return json_encode($this->getData());
	}

	function printJsonData() {
		header('Content-type: application/json');
		echo $this->getJsonData();
		exit;
	}

}