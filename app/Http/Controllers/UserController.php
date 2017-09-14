<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateUserRequest;
use Cronos\Http\Requests\EditUserRequest;


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
        $user = User::where('companieId', Auth::user()->companieId)
            ->find($id);

        $userProjects = $user->projects()
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('user.show', compact('user', 'userProjects'));
    }


    public function edit($id)
    {
        $user = User::where('companieId', Auth::user()->companieId)
            ->find($id);

        return view('user.edit', compact('user'));
    }


    public function update(EditUserRequest $request, $id)
    {
        User::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                //'email' => $request->email,
                'rol' => $request->rol,
                'identificator' => $request->rif,
                'phone' => $request->phone,
                'address' => $request->address,
            ]); 

        session()->flash('success', 'Usuario Actualizado.');
        
        return redirect('/users/' . $id );
    }

    public function disabled($id)
    {
        User::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'state' => 0,
            ]); 

        session()->flash('success', 'Usuario Desactivado.');

        return redirect('/users/' . $id);
    }

    public function enabled($id)
    {
        User::where('companieId', Auth::user()->companieId)
            ->where('id', $id)
            ->update([
                'state' => 1,
            ]); 

        session()->flash('success', 'Usuario Activado.');

        return redirect('/users/' . $id);
    }
}
