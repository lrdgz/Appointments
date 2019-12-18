<ul class="navbar-nav align-items-center d-none d-md-flex">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                              <img alt="Image placeholder" src="{{asset('img/theme/avatar.jpg')}}">
                            </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"> {{ Auth::user()->name }}</span>
                </div>
            </div>
        </a>
        @include('includes.panel.dropdown_menu')
    </li>
</ul>
