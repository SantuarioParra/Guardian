<?php

namespace App\Http\Controllers;

use App\Key;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourcesAppController extends Controller
{
    public function own_leader_projects(Request $request){

        $projects = User::with('project')->where('id','=', $request->user()->id)->first();
        $projects = $projects['project'];
        return response()->json($projects);

    }
    public function own_second_leader_projects(Request $request){

        $projects_s = DB::table('projects')->join('users','users.id' ,'=','projects.s_leader')
            ->where('users.id','=',$request->user()->id)
            ->select('projects.id','projects.f_leader','projects.s_leader','projects.name','projects.description','finished_at','projects.created_at','projects.updated_at')
            ->get();

        return response()->json($projects_s);

    }
    public function own_research_projects(Request $request){

        $projects_r = User::with('research_project')->where('id','=', $request->user()->id)->first();
        $projects_r = $projects_r['research_project'];
        return response()->json($projects_r);

    }
    public function get_Fragment(Request $request){
        $fragment = new Key();
        $fragment->project_id = $request->get('project_id');
        $fragment->fragment = $request->get('fragment');
        if ($fragment->save()){
            return response()->json(['success'=>"Fragmento recibido correctamente"]);
        }else{
            return response()->json(['error'=>"El fragmento no fue recibido correctamente intente en unos momentos"]);
        }
    }
}
