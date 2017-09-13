<?php
namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Cronos\Http\Requests\CreateProjectRequest;

use Repo\Project;
use Repo\ProjectPartitie;
use Repo\ProjectMaterial;
use Repo\ProjectEquipment;
use Repo\ProjectWorkforce;
use Repo\Modifier;
use Repo\Client;
use Repo\Activity;
use Auth;

use Cronos\model\Cost;
use Cronos\model\CostPartitie;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $projects = Project::where('companieId', Auth::user()->companieId)
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }

                if (Auth::user()->rol == 0) {
                    $query->where('userId', Auth::user()->id);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('project.index', compact('projects', 'search'));
    }

    public function create()
    {
        $clients = Client::where('companieId', Auth::user()->companieId)
            ->where('disabled', 0)
            ->get();

        return view('project.create', compact('clients'));
    }

    public function store(CreateProjectRequest $request)
    {
        $projectId = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start' => date("Y-m-d"),
            'end' => date("Y-m-d"),
            'finish' => date("Y-m-d"),
            'companieId' => Auth::user()->companieId,
            'clientId' => $request->client,
            'stateId' => $request->status,
            'userId' => Auth::user()->id,
        ])->id;

        $modifiers = [
            [
                'name' => 'fcas',
                'amount' => $request->fcas,
                'type' => 1,
            ],
            [
                'name' => 'expenses',
                'amount' => $request->expenses,
                'type' => 1,
            ],
            [
                'name' => 'utility',
                'amount' => $request->utility,
                'type' => 1,
            ],
            [
                'name' => 'unexpected',
                'amount' => $request->unexpected,
                'type' => 1,
            ],
            [
                'name' => 'bonus',
                'amount' => $request->bonus,
                'type' => 1,
            ],
            [
                'name' => 'salary',
                'amount' => $request->salary,
                'type' => 2,
            ],
            [
                'name' => 'salaryBonus',
                'amount' => $request->salaryBonus,
                'type' => 2,
            ],
        ];

        foreach ($modifiers as $modifier) {
            Modifier::create(array_merge($modifier, [
                'projectId' => $projectId,
            ]));
        }

        $order = 0;

        if (count($request->partities)) {
            foreach ($request->partities as $partitie) {
                $partitieId = ProjectPartitie::create([
                    'yield' => $partitie['yield'],
                    'quantity' => $partitie['quantity'],
                    'projectId' => $projectId,
                    'partitieId' => $partitie['id'],
                    'userId' => Auth::user()->id,
                    'order' => $order++,
                    'parent' => 0
                ])->id;


                if (isset($partitie['materials'])) {
	                foreach ($partitie['materials'] as $material) {
	                    ProjectMaterial::create([
	                        'partitieId' => $partitieId,
	                        'materialId' => $material['materialId'],
	                        'costId' => $material['costId'],
                            'quantity' => $material['quantity'],
	                    ]);
	                }
            	}

                if (isset($partitie['equipments'])) {
                	foreach ($partitie['equipments'] as $equipment) {
	                    ProjectEquipment::create([
	                        'partitieId' => $partitieId,
	                        'equipmentId' => $equipment['equipmentId'],
	                        'costId' => $equipment['costId'],
                            'quantity' => $equipment['quantity'],
	                    ]);
	                }
            	}

                if (isset($partitie['workforces'])) {
	                foreach ($partitie['workforces'] as $workforce) {
	                    ProjectWorkforce::create([
	                        'partitieId' => $partitieId,
	                        'workforceId' => $workforce['workforceId'],
	                        'costId' => $workforce['costId'],
                            'quantity' => $workforce['quantity'],
	                    ]);
	                }
            	}
            }
        }

        session()->flash('success', 'Proyecto Creado.');

        return response()->json(['status'=>'redirect']);
    }

    public function show($id)
    {
        $project = Project::where('companieId', Auth::user()->companieId)
            ->where(function ($query) {
                if (Auth::user()->rol == 0) {
                    $query->where('userId', Auth::user()->id);
                }
            })
            ->find($id);

        if (!$project) {
            return redirect('/projects');
        }

        $projectModifiers = Modifier::where('projectId', $id)->get();

        $modifiers = [];

        foreach ($projectModifiers as $modifier) {
            $modifiers[$modifier->name] = $modifier->amount;
        }

        $calculator = new CostPartitie($modifiers);

        return view('project.show', compact('project', 'projectModifiers', 'calculator'));
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

        Modifier::where('projectId', $id)->delete();
        $projectPartities = ProjectPartitie::where('projectId', $id)->get();
        
        if ($projectPartities) {
            foreach ($projectPartities as $partitie) {
                ProjectMaterial::where('partitieId', $partitie->id)->delete();
                ProjectEquipment::where('partitieId', $partitie->id)->delete();
                ProjectWorkforce::where('partitieId', $partitie->id)->delete();
                Activity::where('partitieId', $partitie->id)->delete();
            }

            ProjectPartitie::where('projectId', $id)->delete();
        }
        
        Project::where('id', $id)->delete();

        session()->flash('success', 'Proyecto Eliminado.');

        return redirect('/projects');
    }

    public function gantt($id)
    {
    	$project = Project::where('companieId', Auth::user()->companieId)->find($id);

    	$projectPartities = $project->partities();

    	foreach ($projectPartities as $partitie) {
    		if(is_null($partitie->activity())) {
    			Activity::create([
    				'partitieId' => $partitie->id,
    				'start' => $project->start,
    				'end' => $project->start,
    				'finish' => $project->start,
    				'stateId' => 1,
                    'progress' => 0,
                    'note' => ''
    			]);
    		}
    	}

    	return view('project.gantt', compact('project', 'projectPartities'));
    }

    public function partitiePDF($id)
    {
        $project = Project::where('companieId', Auth::user()->companieId)->find($id);

        $projectModifiers = Modifier::where('projectId', $id)->get();

        $modifiers = [];

        foreach ($projectModifiers as $modifier) {
            $modifiers[$modifier->name] = $modifier->amount;
        }

        $calculator = new CostPartitie($modifiers);
        
        $pdf = \PDF::loadView('project.pdf', compact('project', 'calculator'));
        
        return $pdf->stream();
    }

    public function offerPDF($id)
    {
        $project = Project::where('companieId', Auth::user()->companieId)
            ->where(function ($query) {
                if (Auth::user()->rol == 0) {
                    $query->where('userId', Auth::user()->id);
                }
            })
            ->find($id);

        if (!$project) {
            return redirect('/projects');
        }

        $projectModifiers = Modifier::where('projectId', $id)->get();

        $modifiers = [];

        foreach ($projectModifiers as $modifier) {
            $modifiers[$modifier->name] = $modifier->amount;
        }

        $calculator = new CostPartitie($modifiers);

        $pdf = \PDF::loadView('project.offer_pdf', compact('project', 'projectModifiers', 'calculator'))->setPaper('a4', 'landscape');
        
        return $pdf->stream();
    }

    public function saveGantt(Request $request)
    {

    	foreach ($request->partities as $partitie) {
			//echo $this->jsTime($partitie[2]) . '<br>';
			
			Activity::where('partitieId', $partitie[0])
				->update([
					'start' => $this->jsTime($partitie[2]),
				]);


			ProjectPartitie::where('id', $partitie[0])
				->update([
					'parent' => !is_null($partitie[6]) ? $partitie[6] : 0,
				]);
			
    	}

    	return response()->json(['status' => 'success']);
    }

    public function clone($id)
    {
        //
    }

    private function jsTime($time)
    {
		$time = substr($time, 0, strpos($time, '('));

    	return date('Y-m-d', strtotime($time));
    }
}

