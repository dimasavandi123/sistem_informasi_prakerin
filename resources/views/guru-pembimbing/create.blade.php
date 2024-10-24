@extends('admin.index')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('title','Guru Pembimbing')
@section('content')
<main>
    <h1 class="title">Form Guru Pembimbing</h1>
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
            <a type="button" href="{{ route('guru-pembimbing.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
                <div class="alert alert-danger" role="alert">
                    <h3 class="alert-heading">Error</h3>
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>{{ $error }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('guru-pembimbing.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Nama Guru</label>
                    <select name="gurumapel_id" id="gurumapel" class="form-control">
                        <option value="">--Pilih--</option>
                        @foreach ($gurumapel as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama_guru_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Kelas</label>
                    <select name="kelas_id" id="kelas" class="form-control">
                        <option value="">--Pilih Kelas--</option>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}">{{ $kls->kelas_jurusan_siswa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Nama Siswa</label>
                    <select name="siswa_id[]" id="siswa" class="form-control select2" multiple>
                        <option value="">--Pilih Siswa--</option>
                    </select>
                </div>
                <div id="nis-container"></div> <!-- Tempat menampilkan kolom NIS secara dinamis -->
                <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Simpan Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // Mengambil siswa berdasarkan kelas yang dipilih
            $('#kelas').on('change', function () {
                let id_kelas = $('#kelas').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getSiswa') }}",
                    data: { id_kelas: id_kelas },
                    cache: false,
                    success: function (response) {
                        $('#siswa').html(response.options);
                        $('#siswa').select2();  // Re-initiate Select2 setelah options terload
                    },
                    error: function (data) {
                        console.log('error', data);
                    }
                });
            });

            // Mengambil nilai NIS untuk setiap siswa yang dipilih
            $('#siswa').on('change', function () {
                let selectedSiswa = $(this).val();  
                $('#nis-container').empty();  

                
                selectedSiswa.forEach(function (id_siswa) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getNis') }}",
                        data: { id_siswa: id_siswa },
                        cache: false,
                        success: function (response) {
                            
                            $('#nis-container').append(`
                                <div class="form-group mb-3">
                                    <label>NIS Siswa</label>
                                    <input type="text" class="form-control" name="nis_siswa[]" value="${response.nis_siswa}" readonly>
                                </div>
                            `);
                        },
                        error: function (data) {
                            console.log('error', data);
                        }
                    });
                });
            });
        });
    </script>
</main>
@endsection
