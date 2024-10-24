@extends('admin.index')
@section('title','Siswa')
@section('content')
<main>
    <h1 class="title">Form Edit Data Siswa</h1>
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
            <a type="button" href="{{ route('siswa.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="form-group mb-3">
                <label for="">Nama Siswa</label>
                <input type="text" placeholder="Contoh Dimas" name="nama_siswa" value="{{ $siswa->nama_siswa }}">
            </div>
            <div class="form-group mb-3" >
                <label for="">Kelas Siswa</label>
                <select name="kelas_id" id="kelas_id" class="form-select">
                    @foreach ($kelas as $kls)
                        <option value="{{ $kls->id }}" {{ $kls->id == $siswa->kelas_id ? 'selected' : '' }}>{{ $kls->kelas_jurusan_siswa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">NIS</label>
                <input type="number" name="nis_siswa" placeholder="Contoh 50505" value="{{ $siswa->nis_siswa }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Foto Siswa</label>
                <input type="file" name="foto_siswa">
                <img src="{{ asset('uploads/siswa/'.$siswa->foto_siswa) }}" height="90" width="70" class="mt-3" >
            </div>
            <div class="form-group mb-3">
                <label for="">Tmpt Lahir Siswa</label>
                <input type="text" placeholder="Contoh Kendal" name="tmpt_lahir_siswa" value="{{ $siswa->tmpt_lahir_siswa }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Tgl Lahir Siswa</label>
                <input type="date"  name="tgl_lahir_siswa" value="{{ $siswa->tgl_lahir_siswa }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="">
                    <option>{{ $siswa->jenis_kelamin }}</option>
                    <option value="L">L</option>
                    <option value="P">P</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">Nomer Ortu</label>
                <input type="number" name="no_ortu" placeholder="Contoh 081234567891" value="{{ $siswa->no_ortu }}">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection