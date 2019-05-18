@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Holy guacamoly!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Holy guacamoly!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >{{ __('Projects') }}</h2>
                    <a href="{{route('Proyectos.create')}}" class="btn btn-primary btn-sm">Crear</a>
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
                        <div class="card-header">
                            <h4 class="card-text"> {{$project->name}}</h4>
                        </div>
                        <div class="card-body">

                            <div class="card-text">
                                <h6>Descripción: <small>{{$project->description}}</small></h6>
                            </div>
                            <h6>Lider de proyecto: <small class="border-bottom">{{$project->user->name}}</small></h6>
                        </div>
                        <div class="card-footer text-center">
                            <form action="{{route('Proyectos.destroy', $project->id)}}" method="post">
                                <a class="btn btn-sm btn-pill btn-outline-primary  " href="{{route('Proyectos.edit', $project->id )}}">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-pill btn-sm btn-outline-danger" onclick=" return confirm('Esta seguro que desea eliminar el proyecto {{$project->name}}')" >Eliminar</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection