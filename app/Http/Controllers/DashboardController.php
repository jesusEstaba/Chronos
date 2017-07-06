<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Repo\Partitie;
use Repo\Material;
use Repo\Equipment;
use Repo\Workforce;
use Repo\Project;
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
