<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if(auth()->user()->role == 'admin')
       {{ __('Gestionar Datos') }}
    @else
        {{ __('Menu') }}
    @endif
</h6>
<ul class="navbar-nav">
    @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-danger"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/specialties">
                <i class="ni ni-planet text-blue"></i> {{ __('Especialidades') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/doctors">
                <i class="ni ni-single-02 text-red"></i> {{ __('Medicos') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/patients">
                <i class="ni ni-satisfied text-info"></i> {{ __('Pacientes') }}
            </a>
        </li>
    @elseif(auth()->user()->role == 'doctor')
        <li class="nav-item">
            <a class="nav-link" href="/schedule">
                <i class="ni ni-calendar-grid-58 text-danger"></i> Gestionar horario
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/specialties">
                <i class="ni ni-time-alarm text-primary"></i> {{ __('Mis citas') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/specialties">
                <i class="ni ni-satisfied text-info"></i> {{ __('Mis pacientes') }}
            </a>
        </li>
    @else {{-- Patient --}}
        <li class="nav-item">
            <a class="nav-link" href="/appointments/create">
                <i class="ni ni-send text-danger"></i> {{ __('Reservar cita') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/appointments">
                <i class="ni ni-time-alarm text-primary"></i> {{ __('Mis citas') }}
            </a>
        </li>
    @endif
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
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                <i class="ni ni-sound-wave text-yellow"></i>  {{ __('Frecuencia de citas') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                <i class="ni ni-spaceship text-orange"></i>  {{ __('Medicos mas activos') }}
            </a>
        </li>
    </ul>
@endif
