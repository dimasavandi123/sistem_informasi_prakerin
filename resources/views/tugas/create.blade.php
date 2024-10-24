@extends('admin.index') 
@section('title','Tempat-Prakerin')
@section('content')
{{-- CSS --}}
<style>
    .kolom-group {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #F1F0F6;
    }

    .kolom-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .kolom-group input, 
    .kolom-group select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .kolom-group button {
        margin-top: 10px;
        float: right;
    }
</style>

<main>
    <h1 class="title">Form Create Tugas</h1>
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
            <a type="button" href="{{ route('tb-tugas') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_tugas" class="form-label">Judul Tugas</label>
                    <input type="text" class="form-control" name="nama_tugas" value="{{ old('nama_tugas') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
                </div>
                <div id="kolom-container">
                    <div class="kolom-group">
                        <span class="nomor-urut">1.</span>
                        <label for="kolom_nama[]">Soal Tugas:</label>
                        <input type="text" name="kolom_nama[]" required>
                        {{-- <label for="kolom_tipe[]">Tipe Kolom:</label>
                        <select name="kolom_tipe[]" required>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="textarea">Textarea</option>
                        </select> --}}
                        <button type="button" class="btn btn-outline-secondary" onclick="hapusKolom(this)">Hapus Kolom</button>
                    </div>
                </div>
                <button type="button" onclick="tambahKolom()" class="btn btn-outline-secondary">Tambah Soal</button>
                <div class="form-group mb-3">
                    <label for="gurumapel_id">Mapel</label>
                    <select name="gurumapel_id" id="gurumapel_id" class="form-control">
                        <option value="">--Pilih Mapel--</option>
                        @foreach ($gurumapel as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel}}</option>
                        @endforeach
                    </select>
                </div>
                    {{-- TUGAS KE --}}
                    <input type="hidden" name="tugas_ke" class="form-control" value="{{ old('tugas_ke') }}" >
           
                <div class="form-group mb-3">
                    <label for="deadline">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                </div>
                <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Simpan Data</button>
            </form>
        </div>
    </div>
</main>

<script>
    function updateNomorUrut() {
        const kolomGroups = document.querySelectorAll('.kolom-group');
        kolomGroups.forEach((group, index) => {
            const nomorUrut = group.querySelector('.nomor-urut');
            nomorUrut.textContent = (index + 1) + '.';
        });
    }

    function tambahKolom() {
        const kolomContainer = document.getElementById('kolom-container');
        const newKolom = document.createElement('div');
        newKolom.className = 'kolom-group';
        newKolom.innerHTML = `
            <span class="nomor-urut"></span>
            <label for="kolom_nama[]">Soal Tugas:</label>
            <input type="text" name="kolom_nama[]" required>
            <label for="kolom_tipe[]">Tipe Kolom:</label>
            <select name="kolom_tipe[]" required>
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="textarea">Textarea</option>
            </select>
            <button type="button" class="btn btn-outline-secondary" onclick="hapusKolom(this)">Hapus Kolom</button>
        `;
        kolomContainer.appendChild(newKolom);
        updateNomorUrut();
    }

    function hapusKolom(button) {
        const kolomGroup = button.parentNode;
        kolomGroup.remove();
        updateNomorUrut();
    }

    // Update initial numbering
    updateNomorUrut();
</script>
@endsection
