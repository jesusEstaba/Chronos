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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workforce.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workforce = Workforce::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        $workforceCosts = $workforce->costs()
            ->orderBy('id', 'desc')
            ->paginate(5);
        
        return view('workforce.show', compact('workforce', 'workforceCosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workforce = Workforce::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        return view('workforce.edit', compact('workforce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditWorkforceRequest $request, $id)
    {
        Workforce::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]); 

        session()->flash('success', 'Cargo Actualizado.');
        
        return redirect('/workforces/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
