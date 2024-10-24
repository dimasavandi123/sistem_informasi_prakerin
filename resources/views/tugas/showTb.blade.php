@extends('admin.index')
@section('title', 'Jawaban Siswa')
@section('content')
<main>
    <h1 class="title">Jawaban Siswa</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Table</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Detail Jawaban</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            <a href="/tb-tugas" class="btn btn-info float-end">Kembali</a>
            <h3>Detail Tugas</h3>
            <p><strong>Nama Tugas:</strong> {{ $tugas->nama_tugas }}</p>
            <p><strong>Mata Pelajaran:</strong> {{ $tugas->gurumapel->nama_mapel }}</p>
            <p><strong>Tugas Ke:</strong> {{ $tugas->tugas_ke }}</p>
            <p><strong>Isi Tugas:</strong>           @foreach ($tugas->kolomTugas as $index => $soal)
                <p>{{ $index + 1 }}. {{ $soal->kolom_nama }} </p> <!-- Nomor soal otomatis -->
            @endforeach</p>
            
            <form method="GET" action="{{ route('showAnswer', $tugas->id) }}">
                <div class="form-group">
                    <label for="kelas">Filter Kelas:</label>
                    <select name="kelas" id="kelas" class="form-control">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}" {{ $kelasItem->id == $kelasFilter ? 'selected' : '' }}>
                                {{ $kelasItem->kelas_jurusan_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-2 btn-sm">Filter</button>
                <a href="{{ route('showAnswer', $tugas->id) }}" class="btn mt-2 btn-outline-success btn-sm">Reset</a> <!-- Tombol reset -->
            </form>

            <h3>Jawaban Siswa</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Soal & Jawaban</th> <!-- Kolom untuk nomor soal, soal (dihilangkan), dan jawaban -->
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jawabanSiswa as $no => $jwb)
                        <tr>
                            <td>{{ $no + 1 }}</td> <!-- Nomor siswa -->
                            <td>{{ $jwb->users->name }}</td> <!-- Nama siswa -->
                            <td>{{ $jwb->kelas->kelas_jurusan_siswa }}</td> <!-- Kelas siswa -->
                            <td>
                                <strong>Soal:</strong>
                                @foreach ($tugas->kolomTugas as $index => $soal)
                                    <p>{{ $index + 1 }}. {{ $soal->kolom_nama }} </p> <!-- Nomor soal otomatis -->
                                @endforeach
                              
                                <strong>Jawaban:</strong>
                                <p>{{ $index + 1 }}. {{ $jwb->jawaban }}</p> <!-- Menampilkan jawaban siswa -->
                            </td>
                            <td>
                                @if(!is_null($jwb->nilai) && $jwb->nilai->isNotEmpty())
                                    {{ $jwb->nilai->first()->nilai }}
                                @else
                                    <!-- Button trigger modal untuk input nilai -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdropb-{{ $jwb->id }}">
                                        Input Nilai
                                    </button>
                            
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdropb-{{ $jwb->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-{{ $jwb->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel-{{ $jwb->id }}">Tambahkan Nilai</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('nilai.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="jawaban_siswa_id" value="{{ $jwb->id }}">
                                                        <div class="input-group mb-3">
                                                            <button class="btn btn-outline-danger" type="button" id="minus10-{{ $jwb->id }}">-10</button>
                                                            <input type="number" class="form-control text-center" id="nilaiInput-{{ $jwb->id }}" value="0" name="nilai">
                                                            <button class="btn btn-outline-success" type="button" id="plus10-{{ $jwb->id }}">+10</button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('[id^="nilaiModal-"]').forEach(function(modal) {
    modal.addEventListener('hidden.bs.modal', function () {
        let jawabanSiswaId = modal.id.split('-')[1];
        document.getElementById('nilaiInput-' + jawabanSiswaId).value = 0;
    });
});

document.querySelectorAll('[id^="plus10-"]').forEach(function(button) {
    button.addEventListener('click', function () {
        let jawabanSiswaId = button.id.split('-')[1];
        let nilaiInput = document.getElementById('nilaiInput-' + jawabanSiswaId);
        let nilai = parseInt(nilaiInput.value);
        if (nilai + 10 > 100) {
            Swal.fire({
                icon: 'warning',
                title: 'Nilai Melebihi Batas',
                text: 'Nilai tidak boleh lebih dari 100',
                confirmButtonText: 'OK'
            });
        } else {
            nilaiInput.value = nilai + 10;
        }
    });
});

document.querySelectorAll('[id^="minus10-"]').forEach(function(button) {
    button.addEventListener('click', function () {
        let jawabanSiswaId = button.id.split('-')[1];
        let nilaiInput = document.getElementById('nilaiInput-' + jawabanSiswaId);
        let nilai = parseInt(nilaiInput.value);
        nilaiInput.value = Math.max(nilai - 10, 0);
    });
});

document.querySelectorAll('[id^="nilaiInput-"]').forEach(function(input) {
    input.addEventListener('input', function () {
        let nilai = parseInt(input.value);
        if (nilai > 100) {
            Swal.fire({
                icon: 'warning',
                title: 'Nilai Melebihi Batas',
                text: 'Nilai tidak boleh lebih dari 100',
                confirmButtonText: 'OK'
            });
            input.value = 100;
        }
    });
});

</script>
@endsection
