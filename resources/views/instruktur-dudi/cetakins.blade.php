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
    <title>DAFTAR INSTRUKTUR DUDI | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Instruktur Dudi {{ date('Y-m-d') }}</h3>

    <table class="table table-striped table-responsive ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Instruktur</th>
                <th>Tempat Prakerin</th>
                <th>Nama Siswa</th>
                <th>Kelas Siswa</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($instruktur as $no => $ins)
                <tr>
                  
                    <th>{{ $no+1 }}</th>
                    <td>{{ $ins->nama_instruktur }}</td>
                    <td>{{ $ins->prakerin->tempatPrakerin->nama_dudi }}</td>
                    <td>{{ $ins->siswa->nama_siswa }}</td>
                    <td>{{ $ins->kelas->kelas_jurusan_siswa }}</td>
   
                </tr>
            @endforeach
        </tbody>
    </table>

  


</body>
</html>