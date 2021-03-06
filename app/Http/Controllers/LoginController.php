<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isMessage = session()->has('message');

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email, 
            'password' => $request->password,
            'state' => 1 
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        session()->flash('message', 'Datos Erroneos');

        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
