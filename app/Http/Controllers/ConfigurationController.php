<?php

namespace Cronos\Http\Controllers;

use Illuminate\Http\Request;

use Repo\ConfigurationNote;
use Repo\ConfigurationNumeric;
use Repo\ConfigurationString;

class ConfigurationController extends Controller
{
    function __construct() {
       $this->middleware('operatorRestrictedAccess');
    }

    public function index()
    {
        $configNotes = ConfigurationNote::get();
        $configNumerics = ConfigurationNumeric::get();
        $configStrings = ConfigurationString::get();

        return view('config.index', compact(
            'configStrings',
            'configNumerics',
            'configNotes'
        ));
    }

    public function store(Request $request)
    {
        $configType = $request->type;
        $inputs = $request->except(['type', '_token']);
        
        if ($request->type == 'notes') {
            $this->setConfigArray(ConfigurationNote::class, $inputs);
        } elseif ($request->type == 'numerics') {
            $this->setConfigArray(ConfigurationNumeric::class, $inputs);
        } elseif ($request->type == 'strings') {
            $this->setConfigArray(ConfigurationString::class, $inputs);
        }

        session()->flash('success', 'Configuración Actualizada.');
        return redirect('configuration');
    }

    private function setConfigArray($repository, $inputsArray)
    {
        foreach ($inputsArray as $key => $value) {
            $repository::where('name', $key)->update([
                'value' => $value
            ]);
        }
    }
}
