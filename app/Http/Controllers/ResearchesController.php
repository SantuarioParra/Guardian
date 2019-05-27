<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Dumper\PoFileDumper;

class ResearchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $researchers = Project::with('research')->where('id','=',$request->get('id'))->first();
        $researchers = $researchers['research'];
        $id = $request->get('id');
        return view('guardian.researches.index',compact('researchers','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roleUsers = Role::with('users')->where('slug','=','researcher')->first();
        $roleUsers = $roleUsers['users'];
        $roleUsers = $roleUsers->where('device_token','!=',null);
        //dd($roleUsers);
        $id = $request->get('id');

        return view('guardian.researches.add',compact('roleUsers','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::find($request->get('id'));
        $project->research()->attach($request->get('research'));
        return  redirect("Investigadores/create?id=".$request->get('id'))->with('success', ' Investigador Añadido') ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $project = Project::find($request->get('id'));
        if($project->research()->detach($id)){
            return  redirect("Investigadores?id=".$request->get('id'))->with('success', ' Investigador eliminado') ;
        }else{
            return  redirect("Investigadores?id=".$request->get('id'))->with('error', ' No se pudo eliminar al investigador') ;
        }

    }
}
