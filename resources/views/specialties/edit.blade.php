@extends('layouts.panel')
@section('title', 'Specialities')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Especialidad: <b>{{$specialty->name}}</b></h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('specialties') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                    <span class="alert-inner--text"><strong>ERROR!</strong> {{$error}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

        <form action="{{ url('specialties/'. $specialty->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre de la especialidad</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name', $specialty->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descripcion de la especialidad</label>
                <input type="text" name="description" id="description" value="{{ old('name', $specialty->description) }}" class="form-control  @error('description') is-invalid @enderror">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

@endsection
