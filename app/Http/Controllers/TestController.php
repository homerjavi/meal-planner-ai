<?php

namespace App\Http\Controllers;

use App\Models\PlanningSettings;
use App\Services\PlanningPrepareDataService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        $planningSettings = PlanningSettings::find(1);
        $data = (new PlanningPrepareDataService($planningSettings))->getData();

        dd(json_encode($data));

        return view('test');
    }   
}
