@extends('admin.index')
@section('title','Edit Guru Pembimbing')
@section('content')
<main>

    <h1 class="title">Edit Data Guru Pembimbing</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Table</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Edit Data Guru Pembimbing</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('guru-pembimbing.update', $gurupem->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ old('nama_guru', $gurupem->nama_guru) }}">
                </div>

                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <select name="siswa_id" id="siswa_id" class="form-control">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $gurupem->siswa_id ? 'selected' : '' }}>{{ $data->nama_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kelas_id" class="form-label">Kelas Siswa</label>
                    <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $gurupem->kelas_id ? 'selected' : '' }}>{{ $data->kelas_jurusan_siswa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nis_siswa" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis_siswa" name="nis_siswa" value="{{ old('nis_siswa', $gurupem->siswa->nis_siswa) }}" readonly>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection
