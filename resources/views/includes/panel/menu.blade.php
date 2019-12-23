<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if(auth()->user()->role == 'admin')
       {{ __('Gestionar Datos') }}
    @else
        {{ __('Menu') }}
    @endif
</h6>

<ul class="navbar-nav">
    @include('includes.panel.menu.' . auth()->user()->role)
    <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-key-25 "></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
</ul>
@if(auth()->user()->role == 'admin')
    <!-- Divider -->
    <hr class="my-3">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">{{ __('Reportes') }}</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/charts/appointments/line') }}">
                <i class="ni ni-sound-wave text-yellow"></i>  {{ __('Frecuencia de citas') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/charts/doctors/column') }}">
                <i class="ni ni-spaceship text-orange"></i>  {{ __('Medicos mas activos') }}
            </a>
        </li>
    </ul>
@endif
