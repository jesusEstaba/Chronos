<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Cronos\Category;
use Cronos\Unit;
use Cronos\Material;
use Cronos\MaterialCost;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::where('companieId', Auth::user()->companieId)->get();

        return view('material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)->get();
        $units = Unit::all();
  
        return view('material.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        session()->flash('created', true);
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
