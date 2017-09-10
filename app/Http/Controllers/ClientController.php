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
	        'rif' => $request->rif ?? '',
	        'address' => $request->address ?? '',
	        'phone' => $request->phone ?? '',
	        'companieId' => Auth::user()->companieId,
	    ]);

	    session()->flash('success', 'Cliente Creado.');
	    
	    return redirect('/clients');
	}


	public function show($id)
	{
	    //
	}


	public function edit($id)
	{
	    //
	}


	public function update(Request $request, $id)
	{
	    //
	}
}
