<!DOCTYPE html>
<html>
<head>
    <title>Jawaban Siswa</title>
    <style>
        /* Gaya CSS untuk tampilan seperti kertas */
        body {
            font-family: Arial, sans-serif;
        }
        .jawaban-container {
            border: 1px solid black;
            padding: 20px;
            margin: 10px 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .line {
            border-bottom: 1px solid black;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Jawaban Tugas</h2>
    </div>

    <div class="jawaban-container">
        <p><strong>Nama Siswa:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Kelas:</strong> {{ $jawabanSiswa->kelas->kelas_jurusan_siswa }}</p>
        <p><strong>Mapel:</strong> {{ $jawabanSiswa->tugas->gurumapel->nama_mapel }}</p>
        <div class="line"></div>

        <!-- Menampilkan soal dan jawaban dengan nomor berurutan -->
        @foreach ($jawabanSiswa->tugas->kolomTugas as $index => $kolom)
            <p><strong> {{ $index + 1 }}:</strong> {{ $kolom->kolom_nama }}</p>
            <p><strong>Jawaban:</strong> 
                @if ($jawaban = $jawabanSiswa->where('kolom_tugas_id', $kolom->id)->first())
                    {{ $jawaban->jawaban }}
                @else
                    Belum ada jawaban
                @endif
            </p>
            <div class="line"></div>
        @endforeach
    </div>
</body>
</html>
