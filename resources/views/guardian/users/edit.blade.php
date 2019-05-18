@extends('guardian.layouts.app')

@section('content')
    <div class="container container-fluid" role="main">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <h2 class="border-bottom">Usuario: <small class="text-muted">{{$user->name}}</small></h2>

                <form method="post" action="{{route('Usuarios.update',$user->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="idUsuario">ID Usuario</label>
                        <input type="number" name="id" class="form-control" id="idUsuario" placeholder="ID Usuario" value="{{$user->id}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombreUsuario">Nombre</label>
                        <input type="text" name="name" class="form-control" id="nombreUsuario" placeholder="Nombre del Usuario" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="emailUsuario">Email</label>
                        <input type="text" name="email" class="form-control" id="emailUsuario" placeholder="Email del Usuario" value="{{$user->email}}">
                    </div>
                    @if( Auth::user()->id!=$user->id )
                        <div class="form-group" >
                            <label for="rolUsuario">Rol</label>
                            <select class="custom-select" name="idRol">
                                <option selected value="{{$user->role[0]->id}}" >{{$user->role[0]->name}}</option>
                                @foreach($roles as $role)
                                    @if($role->id!=$user->role[0]->id)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="form-group" >
                            <label for="rolUsuario">Rol</label>
                            <input type="text" class="form-control" id="rolUsuario" name="idRol" value="{{$user->role[0]->name}}" disabled>
                        </div>
                    @endif()


                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('Usuarios.index')}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection