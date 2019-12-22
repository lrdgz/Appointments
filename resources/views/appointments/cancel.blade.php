@extends('layouts.panel')
@section('title', 'Cancelar Cita')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Cancelar cita</h3>
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

    <div class="card-body">

        @if($role == 'patient')
            <p>
                Estas apunto de cancelar tu cita reservada con el medico :
                {{ $appointment->doctor->name }}
                ( Especialidad {{ $appointment->specialty->name }})
                para el dia {{ $appointment->scheduled_date }}
            </p>

        @elseif($role == 'doctor')
            <p>
                Estas apunto de cancelar tu cita con el paciente :
                {{ $appointment->patient->name }}
                ( Especialidad {{ $appointment->specialty->name }})
                para el dia {{ $appointment->scheduled_date }}
                (hora {{ $appointment->scheduled_time_12 }} )
            </p>

        @else
            <p>
                Estas apunto de cancelar la cita reservada
                por el paciente {{ $appointment->patient->name }} <br>
                para ser atendido por el medico {{ $appointment->doctor->name }}
                ( Especialidad {{ $appointment->specialty->name }}) <br>
                el dia {{ $appointment->scheduled_date }}
                (hora {{ $appointment->scheduled_time_12 }} ) :
            </p>
        @endif

        <form action="{{ url('/appointments/' . $appointment->id.'/cancel') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="justification">Por favor cuentanos el motivo de la cancelacion:</label>
                <textarea required name="justification" id="justification" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Cancelar cita</button>
            <a href="{{ url('/appointments') }}" class="btn btn-default">Volver al listado de citas sin cancelar</a>
        </form>
    </div>
</div>

@endsection
