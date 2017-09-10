<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateEquipmentRequest;
use Cronos\Http\Requests\EditEquipmentRequest;

use Repo\Equipment;
use Repo\EquipmentCost;
use Repo\Category;
use Auth;

class EquipmentController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    

    public function index(Request $request)
    {
        $search = $request->search;

        $equipments = Equipment::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('equipment.index', compact('equipments', 'search'));
    }


    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)
            ->orderBy('name')
            ->get();
  
        return view('equipment.create', compact('categories'));
    }


    public function store(CreateEquipmentRequest $request)
    {
        $equipmentId = Equipment::create([
            'name' => $request->name,
            'companieId' => Auth::user()->companieId,
            'categoryId' => $request->category,
            'depreciation' => (double) str_replace(',', '.', $request->depreciation)
        ])->id;

        EquipmentCost::create([
            'equipmentId' => $equipmentId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Equipo Creado.');
        
        return redirect('/equipments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        $equipmentCosts = $equipment->costs()
            ->orderBy('id', 'desc')
            ->paginate(5);
        
        return view('equipment.show', compact('equipment', 'equipmentCosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('companieId', Auth::user()->companieId)
            ->get();
        $equipment = Equipment::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        return view('equipment.edit', compact('categories',  'equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditEquipmentRequest $request, $id)
    {   
        Equipment::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'categoryId' => $request->category,
                'depreciation' => (double) str_replace(',', '.', $request->depreciation)
            ]); 

        session()->flash('success', 'Equipo Actualizado.');
        
        return redirect('/equipments/' . $id . '/edit');
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
