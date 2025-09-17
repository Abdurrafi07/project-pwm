<ul class="navbar-nav ms-auto">
    {{-- Guest (Public) --}}
    @guest
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>

        {{-- UMKM --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('noauth.umkm.index') ? 'active' : '' }}"
               href="{{ route('noauth.umkm.index') }}"
               id="navbarUmkm"
               role="button"
               data-bs-toggle="{{ request()->routeIs('noauth.umkm.index') ? 'dropdown' : '' }}"
               aria-expanded="false">
                UMKM
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarUmkm">
                <li>
                    <a class="dropdown-item {{ request('daerah_id') ? '' : 'active' }}" 
                       href="{{ route('noauth.umkm.index', ['kategori_id' => request('kategori_id')]) }}">
                        Semua Daerah
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                @foreach ($daerahList as $daerah)
                    <li>
                        <a class="dropdown-item {{ request('daerah_id') == $daerah->id ? 'active' : '' }}" 
                        href="{{ route('noauth.umkm.index', [
                                'daerah_id' => $daerah->id,
                                'kategori_id' => null
                        ]) }}">
                            {{ $daerah->nama }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <li class="nav-item"><a class="nav-link {{ request()->routeIs('noauth.pengurus.index') ? 'active' : '' }}" href="{{ route('noauth.pengurus.index') }}">Pengurus</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('noauth.lowongan.index') ? 'active' : '' }}" href="{{ route('noauth.lowongan.index') }}">Lowongan</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('noauth.news.index') ? 'active' : '' }}" href="{{ route('noauth.news.index') }}">News</a></li>

        <li class="nav-item"><a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>Register</a></li>
    @endguest

    {{-- User --}}
    @auth
        @if(auth()->user()->isUser())
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="fas fa-user me-1"></i>Profile</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </li>
        @endif

        {{-- Admin --}}
        @if(auth()->user()->isAdmin())
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.kategori.index') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}"><i class="fas fa-tags me-1"></i>Kategori</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-1"></i>Users</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="fas fa-user me-1"></i>Profile</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.daerah.index') ? 'active' : '' }}" href="{{ route('admin.daerah.index') }}"><i class="fas fa-map-marker-alt me-1"></i>Daerah</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.sektor.index') ? 'active' : '' }}" href="{{ route('admin.sektor.index') }}"><i class="fas fa-industry me-1"></i>Sektor</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.umkm.index') ? 'active' : '' }}" href="{{ route('admin.umkm.index') }}"><i class="fas fa-store me-1"></i>UMKM</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.berita.index') ? 'active' : '' }}" href="{{ route('admin.news.index') }}"><i class="fas fa-file-alt me-1"></i>Berita</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.lowongan.index') ? 'active' : '' }}" href="{{ route('admin.lowongan.index') }}"><i class="fas fa-briefcase me-1"></i>Lowongan</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.penguruses.index') ? 'active' : '' }}" href="{{ route('admin.penguruses.index') }}"><i class="fas fa-users-cog me-1"></i>Pengurus</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </li>
        @endif
    @endauth
</ul>
