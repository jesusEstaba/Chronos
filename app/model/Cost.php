<?php

namespace Cronos\model;

class Cost {
	
	private $materials = 0;
	private $equipments = 0;
	private $workforces = 0;

	private $salary;
	private $salaryBonus;

	private $fcas;
	private $expenses;
	private $utility;
	private $unexpected;
	private $bonus;


	function __construct($modifiers) {
		$this->salary = $modifiers['salary'];
		$this->salaryBonus = $modifiers['salaryBonus'];

		$this->fcas = $modifiers['fcas'];
		$this->expenses = $modifiers['expenses'];
		$this->utility = $modifiers['utility'];
		$this->unexpected = $modifiers['unexpected'];
		$this->bonus = $modifiers['bonus'];
	}

	public function getTotalInMaterials()
	{
		return $this->materials;
	}

	public function getTotalInEquipments()
	{
		return $this->equipments;
	}

	public function getTotalInWorkforces()
	{
		return $this->workforces;
	}

	public function totalInMaterial($cost, $qty)
	{
		$materialCost = $this->material($cost) * $qty;
		$this->materials += $materialCost;
		
		return $materialCost;
	}

	public function material($cost)
	{
		return $this->porcentage($cost, $this->unexpected);
	}

	public function totalInEquipment($cost, $depreciation, $qty)
	{
		$equipmentCost = $cost * $depreciation * $qty;
		$this->equipments += $equipmentCost;

		return $equipmentCost;
	}

	public function totalInWorkforce($cost, $qty)
	{
		$workforceCost = $this->workforce($cost) * $qty;
		$this->workforces += $workforceCost;

		return $workforceCost;
	}

	public function workforce($cost)
	{
		return ($this->salaryBonus + $this->porcentage($this->salary, $cost)) / 30;
	}

	private function porcentage($base, $porcentage) 
	{
		return $base + $base * $porcentage / 100;
	}

}
