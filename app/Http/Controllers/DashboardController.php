<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;
use Repo\Partitie;
use Repo\Client;
use Repo\Project;
use Auth;

class DashboardController
{
    public function index()
    {
    	$projectsRecents = Project::where('companieId', Auth::user()->companieId)
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        $projectsFinish = Project::where('companieId', Auth::user()->companieId)
            ->where('end', '>', date('Y-m-d'))
            ->orderBy('end', 'desc')
            ->take(5)
            ->get();


    	$numOfProjects = Project::where('companieId', Auth::user()->companieId)
            ->where(function ($query) {
                if (Auth::user()->rol == 0) {
                    $query->where('userId', Auth::user()->id);
                }
            })
            ->count();
    	
    	$numOfClients = Client::where('companieId', Auth::user()->companieId)
            ->count();
    	
    	$numOfPartities = Partitie::where('companieId', Auth::user()->companieId)
            ->count();

    	return view('dashboard', compact(
    		'numOfProjects',
			'numOfClients',
			'numOfPartities',
            'projectsRecents',
			'projectsFinish'
    	));
    }
}
