
<nav class="navbar fixed-top navbar-expand-lg navbar-light">
    <div class="container">
        <img src="{{ asset('/assets/img/smk.png') }}" class="navbar-img" width="40" height="40" alt="">
        <a class="navbar-brand" href="#">SIP SMKN 7 KENDAL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('about')) ? 'active' : '' }}" href="/about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('berita-terbaru')) ? 'active' : '' }}" href="/berita-terbaru">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('kerjasama')) ? 'active' : '' }}" href="/kerjasama">Kerjasama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('galeri')) ? 'active' : '' }}" href="/galeri">Galeri</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="lainnyaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        LAINNYA
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="lainnyaDropdown">
                        <li><a class="dropdown-item" href="/halaman-visimisi">VISI MISI</a></li>
                        <li><a class="dropdown-item" href="/listSiswa">LIST SISWA</a></li>
                    </ul>
                </li>
                
    
                @guest
                    <!-- Tampilkan tombol Login jika pengguna belum login -->
                    <li class="nav-item">
                        <a class="btn btn-outline-info "  style="margin-left: 30px" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
    
                @auth
                    <!-- Tampilkan profil dan dropdown Logout jika pengguna sudah login -->
                    <li class="nav-item dropdown " style="margin-left: 30px">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->foto_profil ? asset('uploads/userProfil/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" width="30" class="nav-profil rounded-circle" height="30" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/logout"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="/logout" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>    