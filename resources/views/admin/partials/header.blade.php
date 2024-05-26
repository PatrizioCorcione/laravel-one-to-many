<nav class="navbar navbar-expand-lg bg-dark  ">
  <div class="container-fluid">

    <div class="collapse navbar-collapse d-flex flex-md-row-reverse justify-content-between" id="navbarNavDropdown">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  text-white" target="_blanck" href="{{ route('home') }}">Guest Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white" target="_blanck" href="{{ route('admin.home') }}">Admin Home</a>
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
      <form action="{{ route('admin.project.index') }}" method="GET" class="d-flex" role="search">
        <input name="toSearch" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
