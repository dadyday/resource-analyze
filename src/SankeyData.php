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

	function build($mode = null) {
		$this->oModel->oRelationRepo->renderIncome();
		$this->oModel->oRelationRepo->renderCosts();

		$aLayer = $this->oModel->oLayerRepo->findAll()->orderBy('order', Orm\Collection\ICollection::ASC);
		$oLastLayer = null;
		$aColor = ['#9977cc', '#cc4488', '#3388bb', '#44cc88', '#cccc44'];

		$this->aNode = [];
		$this->aLink = [];

		foreach ($aLayer as $i => $oLayer) {
			foreach ($oLayer->aEntity as $oEntity) {

				$this->aNode[] = [
					'key' => $oEntity->id,
					'text' => $oEntity->name,
					'color' => $aColor[$i] ?? null,
					'income' => $oEntity->income,
					'costs' => $oEntity->costs,
				];
			}
		}

		$aRelation = $this->oModel->oRelationRepo->findAll();
		foreach ($aRelation as $oRelation) {
			$aLink = $this->buildLinks($oRelation, $mode);

			$this->aLink = array_merge($this->aLink, $aLink);
		}
	}

	function buildLinks($oRelation, $mode = null) {
		$i = round($oRelation->incomePart * $oRelation->oFrom->income);
		$o = round($oRelation->costsPart * $oRelation->oTo->costs);

		$aRet = [];
		switch ($mode) {
			case 'in':
				$aRet[] = $this->buildLink($oRelation, $i, '#80c080', 'Erlös: ' . $i);
				break;
			case 'out':
				$aRet[] = $this->buildLink($oRelation, $o, '#c08080', 'Kosten: ' . $o);
				break;
			case 'diff':
				$core = min($i, $o);
				$diff = abs($o - $i);
				$color = $i > $o ? '#408040' : '#c04040';
				$delta = $i > $o ? 'Überschuss: ' : 'Defizit: ';

				$aRet[] = $this->buildLink($oRelation, $core, '#80c080', 'Erlös: ' . $i);
				$aRet[] = $this->buildLink($oRelation, $diff, $color, $delta . $diff);
				$aRet[] = $this->buildLink($oRelation, $core, '#c08080', 'Kosten: ' . $o);
				break;
			case 'relo':
				$v = $oRelation->costsPart * 10000;
				$info = sprintf('%s %s (%0.1f%%)', $oRelation->value, $oRelation->unit, $oRelation->costsPart*100);
				$aRet[] = $this->buildLink($oRelation, $v, '#c080c0', $info);
				break;
			case 'reli':
				$v = $oRelation->incomePart * 10000;
				$info = sprintf('%s %s (%0.1f%%)', $oRelation->value, $oRelation->unit, $oRelation->incomePart*100);
				$aRet[] = $this->buildLink($oRelation, $v, '#c080c0', $info);
				break;
			default:
				$v = ($oRelation->incomePart + $oRelation->costsPart) * 5000;
				$aRet[] = $this->buildLink($oRelation, $v, '#c080c0', "$oRelation->value $oRelation->unit");
				break;
		}
		return $aRet;
	}

	function buildLink($oRelation, $value, $color, $info) {
		return [
			'from' => $oRelation->oFrom->id,
			'to' => $oRelation->oTo->id,
			'width' => $value,
			'color' => $color,
			'info' => $info,
		];
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