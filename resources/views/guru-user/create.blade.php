@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    <h1 class="title">Create User Guru</h1>
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
            <a type="button" href="{{ route('guru-user.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('guru-user.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="">Nama</label>
                <input type="text"  name="name">
            </div>
            <div class="form-group mb-3">
                <label for="">Username</label>
                <input type="text"  name="username">
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="email" name="email">
            </div>
            <div class="form-group mb-3">
                <label for="">Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group mb-3">
                <input type="hidden" name="role" value="1">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Simpan Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection