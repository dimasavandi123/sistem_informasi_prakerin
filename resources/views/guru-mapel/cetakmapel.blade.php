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
    <title>DAFTAR MAPEL | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Guru Mapel {{ date('Y-m-d') }}</h3>

    <table class="table table-striped table-responsive ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru Mapel</th>
                <th>NIP Guru</th>
                <th>Nama Mapel</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($gurumapel as $no => $mapel)
                <tr>
                    <th>{{ $no+1 }}</th>
                    <td>{{ $mapel->nama_guru_mapel }}</td>
                    <td>{{ $mapel->nip_guru }}</td>
                    <td>{{ $mapel->nama_mapel }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  


</body>
</html>