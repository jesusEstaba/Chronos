<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateWorkforceRequest;
use Cronos\Http\Requests\EditWorkforceRequest;

use Repo\Workforce;
use Repo\WorkforceCost;
use Auth;

class WorkforceController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    

    public function index(Request $request)
    {
        $search = $request->search;

        $workforces = Workforce::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('workforce.index', compact('workforces', 'search'));
    }


    public function create()
    {
        return view('workforce.create');
    }


    public function store(CreateWorkforceRequest $request)
    {
        $workforceId = Workforce::create([
            'name' => $request->name,
            'companieId' => Auth::user()->companieId,
        ])->id;

        WorkforceCost::create([
            'workforceId' => $workforceId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Cargo Creado.');
        
        return redirect('/workforces');
    }


    public function show($id)
    {
        $workforce = Workforce::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        $workforceCosts = $workforce->costs()
            ->orderBy('id', 'desc')
            ->paginate(5);
        
        return view('workforce.show', compact('workforce', 'workforceCosts'));
    }


    public function edit($id)
    {
        $workforce = Workforce::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        return view('workforce.edit', compact('workforce'));
    }


    public function update(EditWorkforceRequest $request, $id)
    {
        Workforce::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]); 

        session()->flash('success', 'Cargo Actualizado.');
        
        return redirect('/workforces/' . $id);
    }


    public function disabled($id)
    {
        Workforce::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'disabled' => 1,
            ]); 

        session()->flash('success', 'Cargo Desactivado.');

        return redirect('/workforces/' . $id);
    }


    public function enabled($id)
    {
        Workforce::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'disabled' => 0,
            ]); 

        session()->flash('success', 'Cargo Activado.');

        return redirect('/workforces/' . $id);
    }
}
