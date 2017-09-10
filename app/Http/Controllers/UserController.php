<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateUserRequest;

use Repo\User;
use Auth;

class UserController extends Controller
{
	function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('user.index', compact('users', 'search'));
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->name,
	        'email' => $request->email, 
	        'password' => bcrypt($request->password), 
	        'companieId' => Auth::user()->companieId,
	        'rol' => $request->rol,
	        'state' => $request->state,
	        'identificator' => $request->rif ?? '',
	        'phone' => $request->phone ?? '',
	        'address' => $request->address ?? '',
        ]);

        session()->flash('success', 'Usuario Creado.');
        
        return redirect('/users');
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


    public function destroy($id)
    {
        //
    }
}
