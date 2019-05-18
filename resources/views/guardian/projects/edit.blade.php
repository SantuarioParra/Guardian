@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >{{$project->name}}</h2>
                </div>
                <div class="container-fluid py-3">
                    <form method="post" action="{{route('Proyectos.update', $project->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-row">
                            <div class=" col-sm-12 col-md-12 col-lg-12 mb-3">
                                <label for="name">Nombre del proyecto</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="Nombre del proyecto" value="{{$project->name}}" required>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <label for="description">Descripción del proyecto*</label>
                                <input type="text" name="description" class="form-control" id="description"
                                       placeholder="Descripción del proyecto" value="{{$project->description}}">
                            </div>

                            <div class="col-md-4 mb-3 ">
                                <label for="f_leader">Lider de proyecto principal</label>
                                <select class="custom-select" name="f_leader">
                                    @foreach($leaders as $leader)
                                        @if($leader->id == $project->f_leader)
                                            <option value="{{$leader->id}}" selected>{{$leader->name}}</option>
                                        @else
                                            <option value="{{$leader->id}}">{{$leader->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="s_leader">Lider de proyecto secundario</label>
                                <select class="custom-select" name="s_leader">
                                    @foreach($leaders as $leader)
                                        @if($leader->id == $project->s_leader)
                                            <option value="{{$leader->id}}" selected>{{$leader->name}}</option>
                                        @else
                                            <option value="{{$leader->id}}">{{$leader->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="finished_at">Fecha de finalización</label>
                                <input type="datetime-local" name="finished_at" class="form-control" id="finished_at" value="{{ date('Y-m-d\TH:i',strtotime($project->finished_at))}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('Proyectos.index')}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection