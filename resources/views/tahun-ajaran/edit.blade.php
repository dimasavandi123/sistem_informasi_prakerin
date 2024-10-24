@extends('admin.index')
@section('title','Tahun Ajaran')
@section('content')
<main>
    <h1 class="title">Tahun Ajaran</h1>
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
            <a type="button" href="{{ route('siswa-user.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('tahun-ajaran.update',$tahunAjaran->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group mb-3">
                <label for="">Tahun Ajaran</label>
                <input type="text"  name="tahun_ajaran" value="{{ $tahunAjaran->tahun_ajaran }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Semester</label>
               <select name="semester" id="" class="form-select">
                <option value="">{{ $tahunAjaran->semester }}</option>
                <option value="Ganjil">Ganjil</option>
                <option value="genap">Genap</option>
               </select>
            </div>
          
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection