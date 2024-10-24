@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    
    <h1 class="title">Jawaban </h1>
    <ul class="breadcrumbs">
        <li><a href="#">Show</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('dikerjakan') }}" class="btn btn-primary">Kembali</a>
           
          </div>
    </ul>
    
     <div class="card">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert">
                <span>{{ session('danger') }}</span>
            </div>
        @endif
        @if (count($errors)>0)
            <div class="alert alert-danger " role="alert">
                <h3 class="alert-heading ">Error</h3>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif

            <div class="mt-3" style="overflow-x: auto;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Jawaban {{ auth()->user()->name }} <div class="spinner-grow text-danger spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div></a>
                    </li>
                  </ul>
                  <div class="card mt-3">
                    <div class="card-header card-header-s">
                      {{ $tugas->nama_tugas }} - {{ $tugas->gurumapel->nama_mapel }} - SOAL
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <p>{!! $tugas->tugas_siswa !!}</p>
                      </blockquote>
                    </div>
                  </div>
            </div> 
            <div class="mt-3">
                <a href="{{ route('pdfjawaban', ['id' => $tugas->id]) }}" target="_blank" class="btn btn-danger btn-sm float-end">
                    <i class='bx bxs-file-pdf'></i> </a>
                
                <h5 class="fw-bold">Jawaban</h5>
                <div class="card">
                    <div class="card-body bg-light">
                        <h6>Nama: {{ auth()->user()->name }}</h6>
                        @if ($jawabanSiswa->isNotEmpty())
                            {{-- Mengambil kelas dari jawabanSiswa --}}
                            <h6>Kelas: {{ $jawabanSiswa->first()->kelas->kelas_jurusan_siswa }}</h6>
                        @else
                            <h6>Kelas: Belum ada kelas</h6>
                        @endif
                    
                        @foreach ($tugas->kolomTugas as $index => $kolom)
                            <p>
                                <strong>{{ $index + 1 }}. {{ $kolom->kolom_nama }}</strong> {{-- Menampilkan nomor soal dan soalnya --}}
                            </p>
                            <p>
                                @if ($jawaban = $tugas->jawabanSiswa->where('kolom_tugas_id', $kolom->id)->first())
                                    Jawaban: {{ $jawaban->jawaban }}
                                @else
                                    <span class="text-danger">Belum ada jawaban</span>
                                @endif
                            </p>
                            <hr> {{-- Garis pemisah antar soal --}}
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
     </div>    

</main>

@endsection