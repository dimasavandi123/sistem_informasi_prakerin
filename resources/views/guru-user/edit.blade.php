@extends('admin.index')
@section('title','Tempat-Prakerin')
@section('content')
<main>
    <h1 class="title">Update User Siswa</h1>
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
            <form action="{{ route('guru-user.update',$guruUser->id) }}" method="POST">
                @csrf
                @method('patch')
            <div class="form-group mb-3">
                <label for="">Nama</label>
                <input type="text"  name="name" value="{{ old('name',$guruUser->name) }}">
            </div>
            <div class="form-group mb-3">
                <label for="">Username</label>
                <input type="text"  name="username" value="{{ old('username',$guruUser->username) }}">
            </div>
            
                <input type="hidden" name="password" value="{{ $guruUser->password }}">
            
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ old('email',$guruUser->email) }}">
            </div>
            <div class="form-group mb-3">
                <div class="form-group mb-3">
                    <input type="hidden" name="role" value="1">
                </div>
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    

</main>
@endsection