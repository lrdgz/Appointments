@extends('layouts.panel')
@section('title', 'Registrar Nueva Cita')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registrar Nueva Cita</h3>
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

            <form action="{{ url('appointments') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <input type="text" class="form-control" placeholder="Describe brevemente la consulta" name="description" value="{{old('description')}}" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="speciality">Especialidad</label>
                        <select name="specialty_id" id="specialty" class="form-control" required>
                            <option value="">Seleccionar Especialidad</option>
                            @foreach($specialties as $specialty)
                                <option value="{{$specialty->id}}" @if(old('specialty_id') == $specialty->id) selected @endif>{{$specialty->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor">Medico</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            <option value="">Seleccionar Medico</option>
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if(old('doctor_id') == $doctor->id) selected @endif>{{$doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" name="scheduled_date" id="date"
                               class="form-control datepicker"
                               placeholder="Seleccionar fecha" value="{{ old('scheduled_date', date('Y-m-d')) }}"
                               data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}"
                               data-date-end-date="+30d">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_time">Hora de Atencion</label>
                    <div id="hours">
                        @if($intervals)
                            @foreach($intervals['morning'] as $key => $interval)
                                <div class="custom-control custom-radio mb-3">
                                    <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalMorning{{$key}}" type="radio" required>
                                    <label class="custom-control-label" for="intervalMorning{{$key}}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                </div>
                            @endforeach

                            @foreach($intervals['afternoon'] as $key => $interval)
                                <div class="custom-control custom-radio mb-3">
                                    <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalAfternoon{{$key}}" type="radio" required>
                                    <label class="custom-control-label" for="intervalAfternoon{{$key}}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info" role="alert">
                                <strong>Informacion!</strong> Selecciona un medico y una fecha, para ver sus horas disponibles.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="type">Tipo de Consulta</label>
                    <div class="custom-control custom-radio mb-3">
                        <input name="type" class="custom-control-input" id="type1" type="radio" value="Consulta"
                               @if(old('type', 'Consulta') == 'Consulta') checked @endif>
                        <label class="custom-control-label" for="type1">Consulta</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input name="type" class="custom-control-input" id="type2" type="radio" value="Examen"
                               @if(old('type') == 'Examen') checked @endif>
                        <label class="custom-control-label" for="type2">Examen</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input name="type" class="custom-control-input" id="type3" type="radio" value="Operacion"
                               @if(old('type') == 'Operacion') checked @endif>
                        <label class="custom-control-label" for="type3">Operacion</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('/js/appointments/create.js')}}"></script>
@endsection
