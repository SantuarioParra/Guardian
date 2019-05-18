<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('user')->get();
        return view('guardian.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leaders = Role::with('users')->where('slug','=','leader')->first();
        $leaders = $leaders['users'];
        //dd($leaders);
        return view('guardian.projects.create', compact('leaders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $project = new Project();
        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->f_leader = $request->get('f_leader');
        $project->s_leader = $request->get('s_leader');
        $project->finished_at = $request->get('finished_at');
        if($project->save()) {
            return redirect('Proyectos')->with('success', 'Proyecto creado');
        }else{
            return redirect('Proyectos')->with('error', 'Algo ha pasado...');
        }
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
        $project = Project::findOrFail($id);
        $leaders = Role::with('users')->where('slug','=','leader')->first();
        $leaders = $leaders['users'];
        //dd($project);
        return view('guardian.projects.edit',compact('project','leaders'));
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
        $project = Project::findOrFail($id);
        $project->name = $request->get('name');
        $project->description = $request->get('description');
        $project->f_leader = $request->get('f_leader');
        $project->s_leader = $request->get('s_leader');
        $project->finished_at = $request->get('finished_at');
        if($project->update()) {
            return redirect('Proyectos')->with('success', 'Proyecto actualizado');
        }else{
            return redirect('Proyectos')->with('error', 'Algo ha pasado...');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if($project->delete()){
            return redirect('Proyectos')->with('success', 'Projecto eliminado');
        }else{
            return redirect('Proyectos')->with('error', 'Algo ha pasado...');
        }
    }
}
