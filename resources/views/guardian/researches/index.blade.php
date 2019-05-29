@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{$message}}</strong>
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
                    <h2 >Investigadores del proyecto </h2>
                    <a href="{{route('Investigadores.create',['id'=>$id])}}" class="btn btn-primary btn-sm">Añadir</a>
                </div>
                <div class="table-responsive">
                    <table>
                        <table class="table table-striped table-hover">
                            @if($researchers->isEmpty())
                                <thead>
                                <tr>
                                    <th>No hay investigadores asociados</th>
                                </tr>
                                </thead>
                            @else
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo Electronico</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>

                            @foreach($researchers as $research)
                                <tr>
                                    <td>{{$research->id}}</td>
                                    <td>{{$research->name}}</td>
                                    <td>{{$research->created_at}}</td>
                                    <td >
                                        <form action="{{ route('Investigadores.destroy',['research'=>$research->id, 'id'=>$id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-pill btn-sm btn-outline-danger btn-block" onclick=" return confirm('Esta seguro que desea eliminar a {{$research->name}}')" >Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection