<?php

namespace Cronos\model;
use Repo\ProjectPartitie;

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
	public $bonus;

	public $projectDuration;
	protected $yield;
	protected $quantity;

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


	public function setPartitie($partitie)
	{
		$this->yield = $partitie->yield;
		$this->quantity = $partitie->quantity;
	}


	protected function getProjectDurationDays()
	{
		if ($this->quantity > 0 && $this->yield > 0) {
			return ceil($this->quantity/$this->yield);
		}

		return 0;
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
		$workforceCost = ($this->bonus + $this->workforce($cost)) * $qty;
		$this->workforces += $workforceCost;

		return $workforceCost;
	}

	public function workforce($cost)
	{
		return 
		($this->salaryBonus + $this->porcentage($this->salary, $cost)) / 30;
	}

	protected  function getBonus() {
		return $this->getProjectDurationDays() * $this->bonus;
	}

	protected function porcentage($base, $porcentage) 
	{
		return $base * (1 + $porcentage / 100);
	}

}
