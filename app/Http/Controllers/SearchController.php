<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Cronos\Material;
use Cronos\Equipment;
use Cronos\Workforce;
use Cronos\MaterialCost;
use Cronos\EquipmentCost;
use Cronos\WorkforceCost;

use Auth;

class SearchController extends Controller
{
    /**
     * este controlador es mientras no hay un Framework MVC. ya que el deber ser
     * es que todo el Backend sea un API REST
     */


    public function materials(Request $request)
    {
    	$search = $request->search;

    	$materials = Material::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->take(10)//limitar o paginar
            ->get();

        foreach ($materials as $material) {
            $material->price = MaterialCost::where('materialId', $material->id)
                ->orderBy('id', 'desc')
                ->first()
                ->cost;
        }

    	return response()->json($materials);
    }

    public function equipments(Request $request)
    {
    	$search = $request->search;

    	$equipments = Equipment::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->take(10)//limitar o paginar
            ->get();

        foreach ($equipments as $equipment) {
            $equipment->price = EquipmentCost::where('equipmentId', $equipment->id)
                ->orderBy('id', 'desc')
                ->first()
                ->cost;
        }

    	return response()->json($equipments);
    }

    public function workforces(Request $request)
    {
        $search = $request->search;

        $workforces = Workforce::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->take(10)//limitar o paginar
            ->get();

        foreach ($workforces as $workforce) {
            $workforce->price = WorkforceCost::where('workforceId', $workforce->id)
                ->orderBy('id', 'desc')
                ->first()
                ->cost;
        }

        return response()->json($workforces);
    }
}
