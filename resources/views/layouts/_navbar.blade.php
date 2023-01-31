<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item dropdown" style="margin-right: 100px;">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ Auth::user()->name }}</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('profile.edit') }}" class="dropdown-item"> Profile </a></li>
              <li class="dropdown-divider"></li>
              
              <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    {{-- <button href="{{ route('logout') }}" class="dropdown-item">Logout</button> --}}
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                          {{ __('Log Out') }}
                    </x-responsive-nav-link>
                    </form>
                </li>
            </ul>
          </li>
    </ul>
</nav>
