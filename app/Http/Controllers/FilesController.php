<?php

namespace App\Http\Controllers;

use App\File;
use App\Notifications\llavesNotification;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $files = Project::with('files')->where('id','=',$request->get('id'))->first();
        $files = $files['files'];
        $id = $request->get('id');
        //dd($files);
        return view('guardian.files.index',compact('files','id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd();
        $id = $request->get('id');
        return view('guardian.files.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cont=0;
        $fileR= new File();
        $id = $request->get('id');
        $fileR->project_id = $id;
        $fileR->description = $request->get('description');

        //obtencion de datos
        $investigadores = Project::with('research')->find($id);
        $investigadores = $investigadores['research'];
        $cont += $investigadores->count('id');
        $lideres = Project::find($id);
        if($lideres->f_leader != $lideres->s_leader){
            $cont +=2;
            $lideres = User::where('id','=',$lideres->f_leader)->orWhere('id','=',$lideres->s_leader)->get();

        }else{
            $lideres = User::where('id','=',$lideres->f_leader)->get();
            $cont +=1;
        }

        $fileR->minr = $cont;
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $fileR->name =$name; //almacenar el nombre del archivo
            $file->move(public_path('/uploads/'),$name);
            $url_temp = public_path('/uploads/'.$name);
            $aesC = new Process("python C:\laragon\www\Guardian\AES_Scripts\AES.py -c -f $url_temp");
            $aesC->run();
            // executes after the command finishes
            if (!$aesC->isSuccessful()) {
                throw new ProcessFailedException($aesC);
            }
            $key = $aesC->getOutput();
            if(Storage::disk('ftp')->put($name, $url_temp)){
                unlink($url_temp);
                $url = Storage::disk('ftp')->get($name);
                $fileR->url = $url;
                $fileR->save();
                //separacion de llave
                if ($key != 404){
                    if($cont < 5){
                        $shamirD = new Process("python C:\laragon\www\Guardian\AES_Scripts\Secret_Sharing.py -d -k $key -min $cont -max 10");
                    }elseif ($cont ==5){
                        $shamirD = new Process("python C:\laragon\www\Guardian\AES_Scripts\Secret_Sharing.py -d -k $key -min 3 -max 10");
                    }else if ($cont>5){
                        $shamirD = new Process("python C:\laragon\www\Guardian\AES_Scripts\Secret_Sharing.py -d -k $key -min 5 -max 10");
                    }
                    $shamirD->run();
                    // executes after the command finishes
                    if (!$shamirD->isSuccessful()) {
                        throw new ProcessFailedException($shamirD);
                    }
                    $fragmentos = explode(",", $shamirD->getOutput());
                    array_pop($fragmentos);

                    if ($cont==2){
                        for ($i=0; $i<$cont; $i++){
                            $user = $lideres[$i] ;
                            $user->notify(new llavesNotification($id,$fragmentos[$i],"Proyecto: $id key"));
                        }
                    }elseif($cont>2){
                        for ($i=0; $i<$cont; $i++){
                            if ($i<2) {
                                $user = $lideres[$i];
                                $user->notify(new llavesNotification($id, $fragmentos[$i], "Proyecto: $id key"));
                            }else{
                                $user = $investigadores[$i-2] ;
                                $user->notify(new llavesNotification($id,$fragmentos[$i],"Proyecto: $id key"));
                            }
                        }
                    }

                }

                return redirect("Archivos?id=$id")->with('success', ' Archivo subido al servido');


            }else{
                return redirect("Archivos?id=$id")->with('error', 'Ha ocurrido un problema...');
            }
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
    public function destroy($id)
    {
        //
    }
}
