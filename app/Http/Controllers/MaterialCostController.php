<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\AddCostRequest;

use Repo\MaterialCost;

class MaterialCostController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    

    public function store(AddCostRequest $request)
    {
        MaterialCost::create([
            'materialId' => $request->materialId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Costo Agregado.');

        return redirect('/materials/' . $request->materialId);
    }
}
