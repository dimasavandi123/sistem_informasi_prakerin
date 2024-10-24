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
    <title>DAFTAR SISWA PRAKERIN | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Siswa Prakerin {{ date('Y-m-d') }}</h3>

        <table class="table table-bordered table-responsive ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas </th>
                    <th>NIS</th>
                    <th>Guru Pembimbing</th>
                    <th>Tempat Prakerin</th>
                    <th>Pimpinan Dudi</th>
                    <th>Alamat Dudi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prakerin as $no => $pkl)
                    <tr>
                        <th>{{ $no+1 }}</th>
                        <td>{{ $pkl->siswa->nama_siswa }}</td>
                        <td>{{ $pkl->kelas->kelas_jurusan_siswa }}</td>
                        <td>{{ $pkl->siswa->nis_siswa }}</td>
                        <td>{{ $pkl->gurupem->nama_guru }}</td>
                        <td>{{ $pkl->tempatPrakerin->nama_dudi }}</td>
                        <td>{{ $pkl->nama_pimpinan }}</td>
                        <td>{{ $pkl->alamat_dudi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  


</body>
</html>