<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Cronos\Partitie;
use Cronos\Material;
use Cronos\Equipment;
use Cronos\Workforce;
use Cronos\Project;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	$numOfMaterials = Material::where('companieId', Auth::user()->companieId)->count();
    	$numOfEquipments = Equipment::where('companieId', Auth::user()->companieId)->count();
    	$numOfWorkforces = Workforce::where('companieId', Auth::user()->companieId)->count();
    	$numOfPartities = Partitie::where('companieId', Auth::user()->companieId)->count();

    	return view('dashboard', compact(
    		'numOfMaterials',
			'numOfEquipments',
			'numOfWorkforces',
			'numOfPartities'
    	));
    }
}
