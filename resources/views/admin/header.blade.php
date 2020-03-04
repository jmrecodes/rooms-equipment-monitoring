<header class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    <img src="{{ URL::to('/')}}/images/logo.png" />
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin Dashboard</a><br>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ $navs['home'] }}">
                <a class="nav-link" href="{{ route('admin') }}">Home</a>
            </li>
            <li class="nav-item {{ $navs['equipment'] }}">
                <a class="nav-link" href="{{ route('equipment') }}">Tools & Equipment</a>
            </li>
            <li class="nav-item {{ $navs['room'] }}">
                <a class="nav-link" href="{{ route('room') }}">Rooms</a>
            </li>
            <li class="nav-item {{ $navs['monitor'] }}">
                <a class="nav-link" href="{{ route('monitor') }}">Monitor & Manage</a>
            </li>
        </ul>

        <a class="nav-link" href="{{ route('settings') }}" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i
                    class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Account settings</span>
        </a>
        <a class="nav-link d-none d-lg-inline text-gray-600 small" href="{{ route('logout') }}">Log out</a>

    </div>
</nav>
