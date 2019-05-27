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
                    <h2 >{{ __('Archivo de proyecto') }}</h2>
                    <a href="{{route('Archivos.create',['id'=>$id])}}" class="btn btn-primary btn-sm">Subir/Actualizar</a>
                </div>
            </div>
        </div>
        <div class="row">
            @if(is_null($files))
                <div class="col-md-12">
                    <h4>{{ __('No File yet') }}</h4>
                </div>
            @else

                    <div class="col-md-12">
                        <div class="py-2">
                            <div class="card" >
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"> {{$files->name}}</h4>
                                    <div class="btn-group" role="group" aria-label="Opciones">
                                        @role('admin')
                                        <form action="{{route('Archivos.destroy', $files->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-sm btn-outline-danger" onclick=" return confirm('Esta seguro que desea eliminar el archivo {{$files->name}}')" ><a class="fa fa-times" ></a></button>
                                        </form>
                                        @endrole
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-text">
                                        <h6>Descripción: <small>{{$files->description}}</small></h6>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-sm btn-pill btn-outline-info btn-block  " href="{{route('Archivos.show',['id'=>$files->id,'project_id'=>$id])}}">Descargar <i class="icon-docs"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
            @endif
        </div>
    </div>
@endsection