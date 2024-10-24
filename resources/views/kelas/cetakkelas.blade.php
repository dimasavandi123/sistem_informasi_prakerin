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
    <title>DAFTAR KELAS | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Kelas {{ date('Y-m-d') }}</h3>

        <table class="table table-bordered table-responsive ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas & Jurusan Siswa</th>
                    <th>Nama Siswa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $no => $hasil)
                    <tr>
                        <th>{{ $no+1 }}</th>
                        <td>{{ $hasil->kelas_jurusan_siswa }}</td>
                        <td>
                            @foreach ($hasil->siswa as $siswas)
                                {{ $siswas->nama_siswa }} , 
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  


</body>
</html>