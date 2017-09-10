<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\AddCostRequest;

use Repo\EquipmentCost;

class EquipmentCostController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    
    public function store(AddCostRequest $request)
    {
        EquipmentCost::create([
            'equipmentId' => $request->equipmentId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Costo Agregado.');

        return redirect('/equipments/' . $request->equipmentId);
    }
}
