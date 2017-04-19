
<!-- Static navbar -->
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <a class="navbar-brand" href="{{  route('home') }}">Drug Pool</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('selected') }}">View Selected</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('import') }}">Import Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('random') }}">Random Selection</a></li>
                @if(Auth::check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>
        </div>
</nav>