<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            text-align: right;
            margin-top: 20px;
        }
        .summary p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Nilai Semester 1 Semester Ganjil</h1>
        <p>Nama Siswa: {{ $user->name }}</p>
        <p>Kelas: {{ $nilaiLengkap->first()->kelas->kelas_jurusan_siswa ?? 'N/A' }}</p>
    </div>

    <h2>Rata-rata Nilai per Mata Pelajaran</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mapel</th>
                <th>Rata-rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaiRataRataMapel as $gurumapelId => $rataRata)
                @php
                    $gurumapel = App\Models\Gurumapel::find($gurumapelId);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gurumapel->nama_mapel ?? 'N/A' }}</td>
                    <td>{{ number_format($rataRata, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Rata-rata Keseluruhan:</strong> {{ number_format($rataRataKeseluruhan, 2) }}</p>
    </div>

    <div class="footer">
        <p>Mengetahui,</p>
        <p>Kepala Sekolah</p>
        <br>
        <p>__________________________</p>
    </div>

</body>
</html>
