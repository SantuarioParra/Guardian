@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >Nuevo usuario</h2>
                </div>
                <div class="container-fluid py-3">
                    <form method="POST" action="{{ route('Usuarios.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label">{{ __('Nombre') }}</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label ">{{ __('E-Mail') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label for="password" class="col-md-12 col-form-label ">{{ __('Contraseña   ') }}</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label for="role" class="col-md-12 col-form-label ">{{ __('Rol') }}</label>

                                        <div class="col-md-12">
                                            <select id="role" name="role" class="form-control custom-select" required>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}"> {{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-sm-auto col-md-auto col-lg-auto  col-xl-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{route('Usuarios.index')}}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection