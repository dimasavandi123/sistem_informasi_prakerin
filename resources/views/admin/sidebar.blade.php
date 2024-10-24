<section id="sidebar">
    <a href="#" class="brand"> <img src="{{ asset('/assets/img/smk.png') }}" alt=""><span>S I P SMKN</span></a>
    <ul class="side-menu">
        {{-- Menu Dashboard --}}
        <li><a href="/dashboard" class="{{ (request()->is('dashboard')) ? 'active' : ''}}"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>

        {{-- Menu Master Data --}}
        @if(auth()->user()->role == 0 || auth()->user()->role == 1)
        <li class="divider" data-text="DATA">DATA</li>
            <li>
                <a href="#" class="{{ (request()->is('siswa','kelas','guru-mapel','tahun-ajaran','jurusan')) ? 'active' : ''}}"><i class='bx bxs-user-detail icon'></i> Master Data <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="/siswa">Data Siswa</a></li>
                    <li><a href="/kelas">Kelas Siswa</a></li>
                    <li><a href="/guru-mapel">Guru Mapel</a></li>
                    <li><a href="/tahun-ajaran">Tahun Ajaran</a></li>
                   
                </ul>
            </li>
            <li><a href="/guru-pembimbing" class="{{ (request()->is('guru-pembimbing')) ? 'active' : ''}}"><i class='bx bxs-user-rectangle icon'></i>Guru Pembimbing</a></li>
        @endif

        {{-- Menu Tugas --}}
        @if(auth()->user()->role == 0 || auth()->user()->role == 1 || auth()->user()->role == 2)
            <li><a href="/tugas" class="{{ (request()->is('tugas','tb-tugas','dikerjakan')) ? 'active' : ''}}"><i class='bx bxs-receipt icon'></i>Tugas Siswa</a></li>
        @endif

        {{-- Menu Nilai (Hanya untuk role 0 dan 1) --}}
        @if(auth()->user()->role == 0 || auth()->user()->role == 1)
            <li><a href="/nilai" class="{{ (request()->is('nilai')) ? 'active' : ''}}"><i class='bx bxs-calculator icon' ></i>Nilai Siswa</a></li>
        @endif

        {{-- Menu Data Prakerin --}}
        @if(auth()->user()->role == 0 || auth()->user()->role == 1)
            <li class="divider" data-text="Prakerin">Data Prakerin</li>
            <li><a href="/prakerin" class="{{ (request()->is('prakerin')) ? 'active' : ''}}"><i class='bx bxs-face icon' ></i>Prakerin Siswa</a></li>
            <li><a href="/instruktur-dudi" class="{{ (request()->is('instruktur-dudi')) ? 'active' : ''}}"><i class='bx bxs-data icon' ></i>Instruktur Dudi</a></li>
            <li><a href="/tempat-dudi" class="{{ (request()->is('tempat-dudi')) ? 'active' : ''}}"><i class='bx bxs-buildings icon' ></i>Tempat Prakerin</a></li>
        @endif

        {{-- Menu Absensi (Hanya untuk role 012) --}}
        @if(auth()->user()->role == 0 || auth()->user()->role == 1 || auth()->user()->role == 2)
            <li><a href="/absen-siswa"  class="{{ (request()->is('absen-siswa')) ? 'active' : ''}}"><i class='bx bxs-time icon'></i>Absensi Siswa</a></li>
        @endif

        {{-- Menu FrontEnd (Hanya untuk role 0) --}}
        @if(auth()->user()->role == 0)
            <li class="divider" data-text="MENU">MENU</li>
            <li>
                <a href="#" class="{{ (request()->is('banner','tentang','berita','galery','visimisi')) ? 'active' : ''}}"><i class='bx bxs-layout icon'></i> FrontEnd <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="/banner">Banner</a></li>
                    <li><a href="/tentang">Tentang</a></li>
                    <li><a href="/berita">Berita</a></li>
                    <li><a href="/collaborate">Kerja Sama</a></li>
                    <li><a href="/galery">Galeri</a></li>
                    <li><a href="/visimisi">Visi Misi</a></li>
                </ul>
            </li>
        @endif

        {{-- Menu User (Hanya untuk role 0) --}}
        @if(auth()->user()->role == 0)
            <li class="divider" data-text="User">User</li>
            <li>
                <a href="#" class="{{ (request()->is('siswa-user','guru-user','admin-user')) ? 'active' : ''}}"><i class='bx bxs-user-account icon'></i>Data User<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="/siswa-user">Siswa User</a></li>
                    <li><a href="/guru-user">Guru User</a></li>
                    <li><a href="/admin-user">Admin User</a></li>
                </ul>
            </li>
        @endif
    </ul>
    <div class="ads">
        <div class="wrapper">
            <a href="/" class="btn-upgrade" target="_blank">Lihat Website</a>
            <p><span></span> <span></span></p>
        </div>
    </div>
</section>
