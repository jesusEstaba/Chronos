<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateClientRequest;

use Repo\Client;
use Auth;

class ClientController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }


    public function index(Request $request)
	{
	    $search = $request->search;

	    $clients = Client::where('companieId', Auth::user()->companieId)
	        ->where(function ($query) use ($search) {
	            if ($search) {
	                $query->where('name', 'like', '%' . $search . '%');
	            }
	        })
	        ->orderBy('id', 'desc')
	        ->paginate(10);

	    return view('client.index', compact('clients', 'search'));
	}


	public function create()
	{
	    return view('client.create');
	}


	public function store(CreateClientRequest $request)
	{
	    Client::create([
	        'name' => $request->name,
	        'rif' => $request->rif,
	        'address' => $request->address,
	        'phone' => $request->phone,
	        'companieId' => Auth::user()->companieId,
	    ]);

	    session()->flash('success', 'Cliente Creado.');
	    
	    return redirect('/clients');
	}


	public function show($id)
	{
	    $client = Client::where('companieId', Auth::user()->companieId)
            ->find($id);

        $clientProjects = $client->projects()
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('client.show', compact('client', 'clientProjects'));
	}


	public function edit($id)
	{
	    $client = Client::where('companieId', Auth::user()->companieId)
            ->find($id);

        return view('client.edit', compact('client'));
	}


	public function update(CreateClientRequest $request, $id)
	{
	    Client::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
		        'rif' => $request->rif,
		        'address' => $request->address,
		        'phone' => $request->phone,
            ]); 

        session()->flash('success', 'Cliente Actualizado.');
        
        return redirect('/clients/' . $id . '/edit');
	}
}
