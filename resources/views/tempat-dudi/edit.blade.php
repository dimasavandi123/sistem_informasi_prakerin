@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    <h1 class="title">Form Edit Tempat Prakerin</h1>
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
            <a type="button" href="{{ route('tempat-dudi.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('tempat-dudi.update',$tempatPrakerin->id) }}" method="POST">
            @method('patch')
                @csrf
            <div class="form-group mb-3">
                <label for="">Tempat Prakerin</label>
                <input type="text" placeholder="Contoh Bengkel..." name="nama_dudi" value="{{ $tempatPrakerin->nama_dudi }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Nama Pimpinan</label>
                <input type="text" placeholder="Contoh Avandi" name="nama_pimpinan" value="{{ $tempatPrakerin->nama_pimpinan }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Alamat Dudi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_dudi" placeholder="Contoh Wonodadi RT 003 RW 006,Plantungan,Kendal" >{{$tempatPrakerin->alamat_dudi }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="">Jumlah Kuota</label>
                <input type="number" placeholder="Max 11" name="jmlh_kuota" value="{{ $tempatPrakerin->jmlh_kuota }}" max="12 required">
            </div>
            <div class="form-group mb-3">
                <label for="">Kuota Terisi</label>
                <input type="number" placeholder="Isi Angka 0 Jika Tempat Dudi Belum Terisi" name="kuota_terisi" value="{{ $tempatPrakerin->kuota_terisi }}" max="12 required">
            </div>
            <div class="form-group mb-3">
                <label for="">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" value="{{ $tempatPrakerin->jurusan }}">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection