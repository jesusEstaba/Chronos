<?php

namespace Cronos\model;

class Cost
{
	
	protected $materials = 0;
	protected $equipments = 0;
	protected $workforces = 0;

	protected $salary;
	protected $salaryBonus;

	protected $fcas;
	protected $expenses;
	protected $utility;
	protected $unexpected;
	protected $bonus;

	public function __construct($modifiers)
	{
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
		$total = $this->materials;
		$this->materials = 0;
		return $total;
	}

	public function getTotalInEquipments()
	{
		$total = $this->equipments;
		$this->equipments = 0;
		return $total;
	}

	public function getTotalInWorkforces()
	{
		$total = $this->workforces;
		$this->workforces = 0;
		return $total;
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

	protected function porcentage($base, $porcentage) 
	{
		return $base + $base * $porcentage / 100;
	}

}
