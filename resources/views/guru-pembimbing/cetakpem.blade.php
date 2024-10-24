<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
           table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <title>DAFTAR GURU PEMBIMBING | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Guru Pembimbing {{ date('Y-m-d') }}</h3>

    <table class="table table-striped table-responsive ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Nama Siswa</th>
                <th>Kelas Siswa</th>
                <th>NIS</th>
          
            </tr>
        </thead>
        <tbody>
            @foreach ($gurupem as $no => $guru)
                <tr>
             
                    <th>{{ $no+1 }}</th>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>{{ $guru->siswa->nama_siswa }}</td>
                    <td>{{ $guru->kelas->kelas_jurusan_siswa }}</td>
                    <td>{{ $guru->siswa->nis_siswa }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
  


</body>
</html>