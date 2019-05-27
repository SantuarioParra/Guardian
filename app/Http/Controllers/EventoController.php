<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;

class EventoController extends Controller
{
    public function solicitarLlave(Request $request){
        $cont=0;
        $id = $request->get('id');
        $project = Project::find($id)->first();
        //dd($one);

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
            if ($cont==2){
                for ($i=0; $i<$cont; $i++){
                    $user = $lideres[$i];
                    $message = new FCMController();
                    $message->sendMessage(120,'Se solicita llave',"Se solicita la llave del proyecto $project->name ",'default',['id_project'=>$id,'fragment'=>'1'],$user->device_token);
                }
            }elseif($cont>2) {
                for ($i = 0; $i < $cont; $i++) {
                    if ($i < 2) {
                        $user = $lideres[$i];
                        $message = new FCMController();
                        $message->sendMessage(120, 'Se solicita llave', "Se solicita la llave del proyecto $project->name ", 'default', ['id_project' => $id, 'fragment' => '1'], $user->device_token);
                    } else {
                        $user = $investigadores[$i - 2];
                        $message = new FCMController();
                        $message->sendMessage(120, 'Se solicita llave', "Se solicita la llave del proyecto $project->name ", 'default', ['id_project' => $id, 'fragment' => '1'], $user->device_token);
                    }
                }
            }
        return redirect("Archivos?id=$id")->with('success', 'Ya se solicitaron las llaves, espere un minuto...');
    }
}
