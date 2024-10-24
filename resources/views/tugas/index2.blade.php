@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    
    <h1 class="title">Tugas Siswa</h1>
    <ul class="breadcrumbs">
        <li><a href="#">View</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('tempat-dudi.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Data</a>
            <a type="button" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
            <a type="button" class="btn btn-success"><i class='bx bxs-file-import' ></i>Import Excel</a>
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

            <div class="mt-3" style="overflow: hidden;">
                <ul class="nav nav-tabs">
                    @if(auth()->user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/tugas">Tugas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active"  href="/dikerjakan">Dikerjakan</a>
                      </li>
                  
                    @else
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/tb-tugas">TB Tugas</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link " aria-current="page" href="/tugas">Tugas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="/dikerjakan">Dikerjakan</a>
                    </li>
                    
                    @endif
                  </ul>
                  <div class="row">
                    @foreach ($tugas as $no => $tgs)
                    <div class="col-12 col-md-4 col-lg-3" >
                        <a href="{{ route('answer',$tgs->id) }}" class="text-dark">
                            <div class="card card-s mt-3" style="width: auto;">
                                <div class="card-body">
                                    <h5 class="card-title card-title-s fw-bold">{{ $tgs->nama_tugas  }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $tgs->gurumapel->nama_mapel }}</h6>
                                    <span class="badge rounded-pill bg-success">Sudah Dikerjakan</span>
                                    <hr>
                                    <p class="fw-lighter">Selesai: 
                                        @php
                                            // Ambil jawaban siswa untuk user saat ini
                                            $jawabanSiswa = $tgs->jawabanSiswa->where('users_id', Auth::id())->first();
                                        @endphp
                
                                        @if ($jawabanSiswa)
                                            {{ \Carbon\Carbon::parse($jawabanSiswa->created_at)->isoFormat('dddd, D MMM Y') }}
                                        @else
                                            <span>Belum ada jawaban</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                
               </div>
               <hr>
            </div> 
        </div>
     </div>

    <!-- FOOTER -->
    
    

</main>

@endsection