@extends('admin.index')
@section('title','Kelas')
@section('content')
<main>
    <h1 class="title">Form Guru Mapel</h1>
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
            <a type="button" href="{{ route('guru-mapel.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('guru-mapel.update',$gurumapel->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group mb-3">
                <label for="">Nama Guru Mapel</label>
                <input type="text" class="form-control" name="nama_guru_mapel" value="{{ $gurumapel->nama_guru_mapel }}">
            </div>
            <div class="form-group mb-3">
                <label for="">NIP Guru</label>
                <input type="number" class="form-control" name="nip_guru" value="{{ $gurumapel->nip_guru }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Nama Mapel</label>
                <input type="text" class="form-control" name="nama_mapel" value="{{ $gurumapel->nama_mapel }}">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection