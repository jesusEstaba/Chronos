<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Cronos\Http\Requests\CreateMaterialRequest;

use Repo\Category;
use Repo\Unit;
use Repo\Material;
use Repo\MaterialCost;

class MaterialController extends Controller
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

        $materials = Material::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('material.index', compact('materials', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)
            ->orderBy('name')
            ->get();
        $units = Unit::where('companieId', Auth::user()->companieId)
            ->get();
  
        return view('material.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMaterialRequest $request)
    {
        $materialId = Material::create([
            'name' => $request->name,
            'companieId' => Auth::user()->companieId,
            'unitId' => $request->unit,
            'categoryId' => $request->category
        ])->id;

        MaterialCost::create([
            'materialId' => $materialId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Material Creado.');
        
        return redirect('/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        $materialCosts = $material->costs()
            ->orderBy('id', 'desc')
            ->paginate(5);
        
        return view('material.show', compact('material', 'materialCosts'));
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
        $material = Material::where('companieId', Auth::user()->companieId)
            ->find($id);
        $units = Unit::all();
        
        return view('material.edit', compact('categories', 'units', 'material'));
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
        Material::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'unitId' => $request->unit,
                'categoryId' => $request->category
            ]); 

        session()->flash('success', 'Material Actualizado.');
        
        return redirect('/materials/' . $id . '/edit');
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
