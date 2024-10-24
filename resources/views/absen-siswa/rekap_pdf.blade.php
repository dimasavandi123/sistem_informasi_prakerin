<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absen Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .summary {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Rekap Absen Siswa</h1>
    <p>Prakerin SMKN 7 Kendal</p>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Waktu Absen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>{{ $absen->kelas->kelas_jurusan_siswa }}</td>
                    <td>{{ $absen->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->isoFormat('dddd, D MMMM Y, H:mm') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Ringkasan Kehadiran di Bawah Tabel -->
    <div class="summary">
        <p>Jumlah Masuk: {{ $jumlahMasuk }}</p>
        <p>Jumlah Telat: {{ $jumlahTelat }}</p>
        <p>Jumlah Izin: {{ $jumlahIzin }}</p>
    </div>
</body>
</html>
