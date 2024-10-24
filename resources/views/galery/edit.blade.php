@extends('admin.index')

@section('title','Galery')
@section('content')
<main>
    <h1 class="title">Form Galery</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Create</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('galery.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('galery.update',$galery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group mb-3">
                <label for="">Judul Galery</label>
                <input type="text"  name="judul_galery" value="{{ $galery->judul_galery }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Gambar Galery</label>
                <input type="file" name="gambar_galery">
                <img src="{{ asset('uploads/galery/'. $galrey->gambar_galery) }}" height="90" width="100" class="mt-3" >
            </div>   
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Simpan Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
</main>
<script>
    $(document).ready(function() {
    $('kelas_jurusan_siswa').select2();
});
</script>
@endsection