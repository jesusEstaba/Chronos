<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Cronos\Http\Requests\CreatePartitieRequest;

use Repo\Category;
use Repo\Unit;
use Repo\Partitie;
use Repo\PartitieMaterial;
use Repo\PartitieEquipment;
use Repo\PartitieWorkforce;
use Auth;

class PartitieController
{
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


    public function create()
    {
        $categories = Category::where('companieId', Auth::user()->companieId)->get();
        $units = Unit::where('companieId', Auth::user()->companieId)->get();
  		$partities = Partitie::where('companieId', Auth::user()->companieId)->get();

        return view('partitie.create', compact(
        	'categories', 
        	'units',
        	'partities'
        ));
    }


    public function store(CreatePartitieRequest $request)
    {
        $partitieId = Partitie::create([
            'name' => $request->name,
            'yield' => $request->yield,
            'companieId' => Auth::user()->companieId,
            'unitId' => $request->unit,
            'userId' => Auth::user()->id,
            'reference' => $request->reference,
            'parent' => $request->parent,
        ])->id;

        $this->addResources($partitieId, $request);

        session()->flash('success', 'Partida Creada.');

        return response()->json(["redirect" => true]);
    }


    private function addResources($partitieId, $request)
    {
        if (count($request->materials)) {
            foreach ($request->materials as $material) {
                PartitieMaterial::create([
                    'partitieId' => $partitieId,
                    'materialId' => $material['id'],
                    'quantity' => $material['qty'],
                    'magnitude' => 0,
                ]);
            }
        }

        if (count($request->equipments)) {
            foreach ($request->equipments as $equipment) {
                PartitieEquipment::create([
                    'partitieId' => $partitieId,
                    'equipmentId' => $equipment['id'],
                    'quantity' => $equipment['qty'],
                    'workers' => $equipment['workers']=="on",
                ]);
            }
        }

        if (count($request->workforces)) {
            foreach ($request->workforces as $workforce) {
                PartitieWorkforce::create([
                    'partitieId' => $partitieId,
                    'workforceId' => $workforce['id'],
                    'quantity' => $workforce['qty'],
                ]);
            }
        }
    }


    public function show($id)
    {
        $partitie = Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->first();

        $materials = PartitieMaterial::where('partitieId', $id)->get();
        $equipments = PartitieEquipment::where('partitieId', $id)->get();
        $workforces = PartitieWorkforce::where('partitieId', $id)->get();

        return view(
            'partitie.show', 
            compact(
                'partitie', 
                'materials', 
                'equipments', 
                'workforces'
            )
        );
    }


    public function edit($id)
    {
        $partitie = Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->first();

        $materials = PartitieMaterial::where('partitieId', $id)->get();
        $equipments = PartitieEquipment::where('partitieId', $id)->get();
        $workforces = PartitieWorkforce::where('partitieId', $id)->get();

        $units = Unit::where('companieId', Auth::user()->companieId)->get();

        return view(
            'partitie.edit', 
            compact(
                'partitie', 
                'materials', 
                'equipments', 
                'workforces',
                'units'
            )
        );
    }


    public function update(CreatePartitieRequest $request, $id)
    {
        Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'yield' => $request->yield,
                'unitId' => $request->unit,
                'reference' => $request->reference,
                'parent' => 0,
            ]);

        PartitieMaterial::where('partitieId', $id)->delete();
        PartitieEquipment::where('partitieId', $id)->delete();
        PartitieWorkforce::where('partitieId', $id)->delete();

        $this->addResources($id, $request);

        session()->flash('success', 'Partida Actualizada.');

        return response()->json(["redirect" => true]);
    }


    public function disabled($id)
    {
        Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'disabled' => 1,
            ]); 

        session()->flash('success', 'Partida Desactivada.');

        return redirect('/partities/' . $id);
    }

    public function enabled($id)
    {
        Partitie::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'disabled' => 0,
            ]); 

        session()->flash('success', 'Partida Activada.');

        return redirect('/partities/' . $id);
    }
}
