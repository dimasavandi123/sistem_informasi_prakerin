@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    
    <h1 class="title">Form Jawaban</h1>
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
            <a type="button" href="{{ route('tugas.index') }}" class="btn btn-primary">Kembali</a>
           
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
                      <a class="nav-link active" aria-current="page" href="#">Sedang Dikerjakan <div class="spinner-grow text-success spinner-grow-sm" role="status">
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
            @if($tugas->isExpired())
            <div class="alert alert-danger mt-3 text-center" role="alert">
                Tugas ini sudah melewati deadline dan tidak bisa dikerjakan lagi.
              </div>
         
            @else
            <div class="mt-3">
                <h5 class="fw-bold">Form Jawaban</h5>
                <div class="card">
                    <div class="card-body bg-light">
                        <form action="{{ route('jawaban.store',$tugas->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <select name="kelas_id" id="" class="form-select">
                                    <option value="">--Pilih Kelas--</option>
                                    @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}">{{ $kls->kelas_jurusan_siswa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                             @foreach($tugas->kolomTugas as $index => $kolom)
                                <div class="form-groub">
                                    <label style="text-transform: capitalize" for="jawaban_{{ $kolom->id }}">{{ $index + 1 }}. {{ $kolom->kolom_nama }}</label>
                                    @if($kolom->kolom_tipe == 'text')
                                        <input type="text" name="jawaban[{{ $kolom->id }}]" id="jawaban_{{ $kolom->id }}">
                                    @elseif($kolom->kolom_tipe == 'textarea')
                                        <textarea name="jawaban[{{ $kolom->id }}]" id="jawaban_{{ $kolom->id }}"></textarea>
                                    @elseif($kolom->kolom_tipe == 'number')
                                        <input type="number" name="jawaban[{{ $kolom->id }}]" id="jawaban_{{ $kolom->id }}">
                                    @endif
                                </div>
                            @endforeach
                            </div>
                            <button type="submit" class="btn btn-success float-end">Kirim Jawaban<i class='bx bx-send'></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        
           
        </div>
     </div>    

</main>

@endsection