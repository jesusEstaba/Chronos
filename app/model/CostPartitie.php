<?php

namespace Cronos\model;
use Repo\ProjectPartitie;

class CostPartitie extends Cost
{
	public $materialsTotal = 0;
	public $equipmentsTotal = 0;
	public $workforcesTotal = 0;

	public $unitaryEquip;
	public $totalfcas;
	public $totalwork;
	public $unitarywork;
	public $resources;
	public $subtotal;
	public $totalUtility;
	public $totalPartitie;

	public function calcPartitie($id, $yield)
	{
		$this->totalInMaterialsByPartitieId($id);
		$this->totalInEquipmentsByPartitieId($id);
		$this->totalInWorkforcesByPartitieId($id);
		$this->cc($yield);
	}


	public function totalInMaterialsByPartitieId($id)
	{
		$projectPartitie = ProjectPartitie::find($id);

		foreach ($projectPartitie->materials() as $material) {
			$total = $this->totalInMaterial($material->cost(), $material->qty());
		}

		$this->materialsTotal = $this->getTotalInMaterials();
	}

	public function totalInEquipmentsByPartitieId($id)
	{
		$projectPartitie = ProjectPartitie::find($id);

		foreach ($projectPartitie->equipments() as $equipment) {
			$total = $this->totalInEquipment(
				$equipment->cost(), 
				$equipment->equipment()->depreciation,
				$equipment->qty()
			);
		}

		$this->equipmentsTotal = $this->getTotalInEquipments();
	}

	public function totalInWorkforcesByPartitieId($id)
	{
		$projectPartitie = ProjectPartitie::find($id);

		foreach ($projectPartitie->workforces() as $workforce) {
			$total = $this->totalInWorkforce($workforce->cost(), $workforce->qty());
		}

		$this->workforcesTotal = $this->getTotalInWorkforces();
	}

	public function cc($yield)
	{
		#TOTAL MATERIALES:
		$this->materialsTotal;
		
		
		
		#TOTAL EQUIPOS:
		$this->equipmentsTotal;
		
		#UNITARIO DE EQUIPOS:
		$this->unitaryEquip = $this->equipmentsTotal/$yield;


		
		#TOTAL MANO DE OBRA:
		$this->workforcesTotal;
		
		#Factor de Costos Asociados al Salario:
		$this->totalfcas = $this->workforcesTotal * $this->fcas/100;

		
		#TOTAL MANO DE OBRA:
		$this->totalwork= $this->workforcesTotal + $this->totalfcas;
		
		#UNITARIO DE MANO DE OBRA:
		$this->unitarywork = $this->totalwork / $yield;
		
		
		#COSTO DIRECTO POR UNIDAD:
		$this->resources = $this->materialsTotal + $this->unitaryEquip + $this->unitarywork;
		
		//GASTOS ADMINISTRATIVOS
		#% ADMINISTRACION Y GASTOS GENERALES:
		$this->totalexpenses = $this->resources * $this->expenses/100;
		
		
		#SUBTOTAL:
		$this->subtotal = $this->resources + $this->totalexpenses;
		#DEPRECIACION DE EQUIPOS
		
		#30% UTILIDAD:
		$this->totalUtility = $this->subtotal * $this->utility/100;
		
		#SUBTOTAL:
		$this->totalPartitie = $this->subtotal + $this->totalUtility;
	}
}
