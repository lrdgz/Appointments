@extends('layouts.panel')
@section('title', 'Doctors')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo Paciente</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('patients') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
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

        <form action="{{ url('patients') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del paciente</label>
                <input type="text" name="name" id="name" min="3" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email del paciente</label>
                <input type="text" name="email" id="email" min="3" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" min="3" class="form-control  @error('dni') is-invalid @enderror" value="{{ old('dni') }}" required>
            </div>
            <div class="form-group">
                <label for="address">Direccion</label>
                <input type="text" name="address" id="address" min="3" class="form-control  @error('address') is-invalid @enderror" value="{{ old('address') }}">
            </div>
            <div class="form-group">
                <label for="phone">Telefono / Movil</label>
                <input type="text" name="phone" id="phone" min="3" class="form-control  @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" min="3" class="form-control  @error('password') is-invalid @enderror" value="{{ Str::random(10) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

@endsection
