<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Cronos\Category;
use Cronos\Unit;
use Cronos\Partitie;
use Cronos\PartitieMaterial;
use Cronos\PartitieEquipment;
use Auth;

class PartitieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $partities = Partitie::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('partitie.index', compact('partities', 'search'));
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
  
        return view('partitie.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partitieId = Partitie::create([
            'name' => $request->name,
            'yield' => $request->yield,
            'companieId' => Auth::user()->companieId,
            'unitId' => $request->unit,
        ])->id;

        foreach ($request->materials as $material) {
            PartitieMaterial::create([
                'partitieId' => $partitieId,
                'materialId' => $material['id'],
                'quantity' => $material['qty'],
                'uniq' => 0,
            ]);
        }

        foreach ($request->equipments as $equipment) {
            PartitieEquipment::create([
                'partitieId' => $partitieId,
                'equipmentId' => $equipment['id'],
                'quantity' => $equipment['qty'],
                'uniq' => 0,
            ]);
        }

        return response()->json(["redirect" => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partitie = Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->first();

        $materials = PartitieMaterial::where('partitieId', $id)
            ->get();

        $equipments = PartitieEquipment::where('partitieId', $id)
            ->get();

        return view('partitie.show2', compact('partitie', 'materials', 'equipments'));
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
