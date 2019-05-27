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
                    <h2 >Añadir investigadores al proyecto </h2>
                </div>
                <div class="table-responsive">
                    <table>
                        <table class="table table-striped table-hover">
                            @if($roleUsers->isEmpty())
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

                            @foreach($roleUsers as $roleUser)
                                <tr>
                                    <td>{{$roleUser->id}}</td>
                                    <td>{{$roleUser->name}}</td>
                                    <td>{{$roleUser->created_at}}</td>
                                    <td >
                                        <form action="{{ route('Investigadores.store',['research'=>$roleUser->id, 'id'=>$id])}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-pill btn-sm btn-outline-success btn-block">Añadir</button>
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