@extends('layouts.panel')
@section('title', '')
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

            <form action="{{ url('patients') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="speciality">Especialidad</label>
                    <select name="specialty_id" id="specialty" class="form-control" required>
                        <option value="">Seleccionar Especialidad</option>
                        @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="doctor">Medico</label>
                    <select name="doctor_id" id="doctor" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input type="text" name="" id="date" class="form-control datepicker" placeholder="Seleccionar fecha" value="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_time">Hora Atencion</label>
                    <input type="text" name="address" id="date_time" min="3" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono/ Movil</label>
                    <input type="phone" name="phone" id="phone" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        let $doctor;
        $(function () {
            const $specialty =  $("#specialty");
            $doctor = $("#doctor");

            $specialty.change(()=>{
                let specialtyID = $specialty.val();
                let url = `/specialties/${specialtyID}/doctors`;
                $.getJSON(url, onDoctorsLoaded);
            });
        });

        const onDoctorsLoaded = function (doctors){
            let htmlOption = '';
            doctors.forEach(doctor => {
                htmlOption += `<option value="${doctor.id}">${doctor.name}</option>`;
            });
            $doctor.html(htmlOption);
        }

    </script>
@endsection
