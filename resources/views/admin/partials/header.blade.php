<nav class="navbar navbar-expand-lg bg-dark  ">
  <div class="container-fluid">

    <div class="collapse navbar-collapse d-flex flex-md-row-reverse " id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  text-white" target="_blanck" href="{{ route('admin.home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white" href="{{ url('profile') }}">{{ Auth::user()->name }}</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
