@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >Usuarios </h2>
                    <a href="{{route('Usuarios.create')}}" class="btn btn-primary btn-sm">Crear</a>
                </div>
                <div class="table-responsive">
                    <table>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo Electronico</th>
                                <th>Fecha de Creación</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    @foreach($user->role as $role)
                                    <td >{{$role->name}}</td>
                                    @endforeach
                                    <td>

                                        <form action="" method="post">
                                            <a class="btn btn-sm btn-pill btn-outline-primary  " href="">Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-pill btn-sm btn-outline-danger" onclick=" return confirm('Esta seguro que desea eliminar a {{$user->name}}')" >Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </table>
                </div>
                {{$users->render()}}
            </div>
        </div>
    </div>
@endsection