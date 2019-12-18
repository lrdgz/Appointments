@extends('layouts.panel')
@section('title', 'Specialities')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Medicos</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('doctors/create') }}" class="btn btn-sm btn-success">Nuevo Medico</a>
            </div>
        </div>
    </div>

    @if(session('notification'))
        <div class="card-body">
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-inner--text"><strong>{{strtoupper(session('type'))}}!</strong> {!! session('notification') !!} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <th scope="row">
                            {{ $doctor->name }}
                        </th>
                        <td>
                            {{ $doctor->email }}
                        </td>
                        <td>
                            {{ $doctor->dni }}
                        </td>
                        <td>
                            <form action="{{ url('doctors/'.$doctor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ url('doctors/'.$doctor->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-body">
        {{ $doctors->links() }}
    </div>
</div>

@endsection
