@extends('guardian.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2 >Nuevo Archivo</h2>
                </div>
                <div class="container-fluid py-3">
                    <form action="{{route('Archivos.store',['id'=>$id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <input type="file" name="file" class="custom-file-input" id="customFile">

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                <label for="description">Descripción del Archivo*</label>
                                <input type="text" name="description" class="form-control" id="description"  placeholder="Descripción del Archivo">
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('Archivos.index',['id'=>$id])}}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection