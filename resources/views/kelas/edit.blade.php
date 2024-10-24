@extends('admin.index')
@section('title','Kelas')
@section('content')
<main>
    <h1 class="title">Form Jurusan & Kelas Siswa</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Update</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('kelas.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
          </div>
    </ul>
    
    <div class="card mt-3">
        <div class="card-body">
            @if (session('success'))
                    <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                        <span>{{ session('success') }}</span>
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
            <form action="{{ route('kelas.update',$kelas->id) }}" method="POST">
            @method('patch')
            @csrf
            <div class="form-group mb-3">
                <label for="">Kelas & Jurusan Siswa</label>
                <input type="text" placeholder="Contoh XII TKJ 1" name="kelas_jurusan_siswa" value="{{ $kelas->kelas_jurusan_siswa }}">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Edit Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection