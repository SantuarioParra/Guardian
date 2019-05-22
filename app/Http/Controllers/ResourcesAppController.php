<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourcesAppController extends Controller
{
    public function own_leader_projects(Request $request){

        $projects = User::with('project')->where('id','=', $request->user()->id)->first();
        $projects = $projects['project'];
        return response()->json(['projects_f_leader'=>$projects]);

    }
    public function own_second_leader_projects(Request $request){

        $projects_s = DB::table('projects')->join('users','users.id' ,'=','projects.s_leader')
            ->where('users.id','=',$request->user()->id)
            ->select('projects.id','projects.f_leader','projects.s_leader','projects.name','projects.description','finished_at','projects.created_at','projects.updated_at')
            ->get();

        return response()->json(['projects_s_leader'=>$projects_s]);

    }
    public function own_research_projects(Request $request){

        $projects_r = User::with('research_project')->where('id','=', $request->user()->id)->first();
        $projects_r = $projects_r['research_project'];
        return response()->json(['projects_researcher'=>$projects_r]);

    }
}
