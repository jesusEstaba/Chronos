<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Cronos\Equipment;
use Cronos\EquipmentCost;
use Cronos\Category;
use Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)->get();
  
        return view('equipment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipmentId = Equipment::create([
            'name' => $request->name,
            'companieId' => Auth::user()->companieId,
            'categoryId' => $request->category
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
    public function update(Request $request, $id)
    {   
        Equipment::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'categoryId' => $request->category
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
