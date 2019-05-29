@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >{{ __('Projects') }}</h2>
                    @role('admin')
                    <a href="{{route('Proyectos.create')}}" class="btn btn-primary btn-sm">Crear</a>
                    @endrole
                </div>
            </div>
        </div>
        <div class="row">
            @if($projects->isEmpty())
                <div class="col-md-12">
                 <h4>{{ __('No projects yet') }}</h4>
                </div>
            @else
                @foreach($projects as $project)
                <div class="col-md-3">
                <div class="py-2">
                    <div class="card" style="max-width: 18rem;">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4 class="card-text"> {{$project->name}}</h4>
                            <div class="btn-group" role="group" aria-label="Opciones">
                                @role('admin')
                                <a class="btn btn-sm btn-outline-primary "href="{{route('Investigadores.index', ['id'=>$project->id] )}}" data-toggle="tooltip" data-placement="top" title="Investigadores"><i class="fa fa-flask"></i></a>
                                <a class="btn btn-sm btn-outline-primary "href="{{route('Proyectos.edit', $project->id )}}" data-toggle="tooltip" data-placement="top" title="Editar" ><i class="icon-pencil"></i> </a>
                                <form action="{{route('Proyectos.destroy', $project->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="btn btn-sm btn-outline-danger" onclick=" return confirm('Esta seguro que desea eliminar el proyecto {{$project->name}}')" ><a class="fa fa-times" ></a></button>
                                </form>
                                @endrole
                            </div>


                        </div>
                        <div class="card-body">

                            <div class="card-text">
                                <h6>Descripción: <small>{{$project->description}}</small></h6>
                            </div>
                            <h6>Lider de proyecto: <small class="border-bottom">{{$project->user->name}}</small></h6>

                        </div>
                        <div class="card-footer">
                            <a class="btn btn-sm btn-pill btn-outline-info btn-block  " href="{{route('Archivos.index', ['id'=>$project->id] )}}">Archivo de proyecto <i class="icon-docs"></i></a>
                        </div>
                    </div>

                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection