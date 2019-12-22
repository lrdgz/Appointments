@extends('layouts.panel')
@section('title', 'Citas')
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Mis citas</h3>
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
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#confirmed-appointments" role="tab" aria-selected="true">Mis proximas citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#pending-appointments" role="tab" aria-selected="false">Citas por confirmar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#old-appointments" role="tab" aria-selected="false">Historial de citas</a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="confirmed-appointments" role="tabpanel">
            @include('appointments.tables.confirmed')
        </div>
        <div class="tab-pane fade" id="pending-appointments" role="tabpanel">
            @include('appointments.tables.pending')
        </div>
        <div class="tab-pane fade" id="old-appointments" role="tabpanel">
            @include('appointments.tables.old')
        </div>
    </div>
</div>

@endsection
