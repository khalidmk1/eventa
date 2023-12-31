<ul class="nav bg-body-nav w-100 p-3  justify-content-evenly">
    <a class="navbar-brand logo_style m-2" href="{{ Route('home.show') }}">EVENTA</a>

    <ul class="nav justify-content-center">
        @auth

            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" role="button"
                    data-mdb-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/avatars/' . auth()->user()->image) }}" class="rounded-circle" height="37"
                        width="37" alt="Avatar" loading="lazy" />
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    @if (auth()->user()->role == 'visiter')
                        <li>
                            <a class="dropdown-item" href="{{ Route('home.profile', auth()->user()->slug) }}">My
                                profile</a>
                        </li>
                    @endif
                    @if (auth()->user()->role == 'organizare' || auth()->user()->role == 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ Route('dashboard.home') }}">Space</a>
                        </li>
                    @endif
                    <form action="{{ Route('logout') }}" method="post">
                        @csrf
                        <li>
                            <button type="submit" class="dropdown-item text-center">Logout</button>
                        </li>
                    </form>

                </ul>
            </li>

            @if (auth()->user()->role == 'visiter')
            <li>
                <a class="btn btn btn-outline-dark m-2" href="{{ Route('home.favoris') }}">
                    <i class="fa-solid fa-bookmark"></i>
                    List Favoris Event</a>
            </li>    
            @endif

        @else
            <a type="button" href="{{ route('login') }}" class="btn btn-light m-2" data-mdb-ripple-init>
                <i class="fa-solid fa-fingerprint"></i> Login
            </a>

        @endauth
        <li class="nav-item">
            <a type="button" href="{{ Route('home.event') }}" class="btn btn-danger m-2" data-mdb-ripple-init><i
                    class="fa-solid fa-calendar"></i>
                Browser Event -></a>
        </li>
    </ul>

</ul>
