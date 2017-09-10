<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\AddCostRequest;

use Repo\WorkforceCost;

class WorkforceCostController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    
    
    public function store(AddCostRequest $request)
    {
        WorkforceCost::create([
            'workforceId' => $request->workforceId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Costo Agregado.');

        return redirect('/workforces/' . $request->workforceId);
    }
}
