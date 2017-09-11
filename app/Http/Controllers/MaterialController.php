<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Cronos\Http\Requests\CreateMaterialRequest;
use Cronos\Http\Requests\EditMaterialRequest;

use Repo\Category;
use Repo\Unit;
use Repo\Material;
use Repo\MaterialCost;

class MaterialController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }
    

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


    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)
            ->orderBy('name')
            ->get();
        $units = Unit::where('companieId', Auth::user()->companieId)
            ->get();
  
        return view('material.create', compact('categories', 'units'));
    }


    public function store(CreateMaterialRequest $request)
    {
        $materialId = Material::create([
            'name' => $request->name,
            'companieId' => Auth::user()->companieId,
            'unitId' => $request->unit,
            'categoryId' => $request->category,
            'junk' => $request->junk,
        ])->id;

        MaterialCost::create([
            'materialId' => $materialId,
            'cost' => $request->cost
        ]);

        session()->flash('success', 'Material Creado.');
        
        return redirect('/materials');
    }


    public function show($id)
    {
        $material = Material::where('companieId', Auth::user()->companieId)
            ->find($id);
        
        $materialCosts = $material->costs()
            ->orderBy('id', 'desc')
            ->paginate(5);
        
        return view('material.show', compact('material', 'materialCosts'));
    }


    public function edit($id)
    {
        $categories = Category::where('companieId', Auth::user()->companieId)
            ->get();
        $material = Material::where('companieId', Auth::user()->companieId)
            ->find($id);
        $units = Unit::all();
        
        return view('material.edit', compact('categories', 'units', 'material'));
    }


    public function update(EditMaterialRequest $request, $id)
    {   
        Material::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'unitId' => $request->unit,
                'categoryId' => $request->category,
                'junk' => $request->junk,
            ]); 

        session()->flash('success', 'Material Actualizado.');
        
        return redirect('/materials/' . $id . '/edit');
    }


    public function destroy($id)
    {
        //
    }
}
