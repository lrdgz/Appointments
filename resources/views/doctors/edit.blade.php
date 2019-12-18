@extends('layouts.panel')
@section('title', 'Doctors')
@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Medico: <b>{{$doctor->name}}</b></h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
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

            <form action="{{ url('doctors/'.$doctor->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del medico</label>
                    <input type="text" name="name" id="name" min="3" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name',$doctor->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email del medico</label>
                    <input type="text" name="email" id="email" min="3" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email',$doctor->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" min="8" class="form-control  @error('dni') is-invalid @enderror" value="{{ old('dni',$doctor->dni) }}">
                </div>
                <div class="form-group">
                    <label for="address">Direccion</label>
                    <input type="text" name="address" id="address" min="3" class="form-control  @error('address') is-invalid @enderror" value="{{ old('address',$doctor->address) }}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono / Movil</label>
                    <input type="text" name="phone" id="phone" min="3" class="form-control  @error('phone') is-invalid @enderror" value="{{ old('phone',$doctor->phone) }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" min="3" class="form-control  @error('password') is-invalid @enderror" value="">
                    <p>Ingrese un valor solo si desea modificar la contraseña</p>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@endsection
