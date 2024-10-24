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
    <title>DAFTAR SISWA | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Siswa Prakerin {{ date('Y-m-d') }}</h3>

        <table class="table table-bordered table-responsive ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas Siswa</th>
                    <th>NIS</th>
                    <th>Foto Siswa</th>
                    <th>Tmpt Lahir Siswa</th>
                    <th>Tgl Lahir Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomer Ortu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $no =>  $data)
                    <tr>
                        <th>{{ $no+1 }}</th>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->kelas->kelas_jurusan_siswa }}</td>
                        <td>{{ $data->nis_siswa }}</td>
                        <td>
                            @if ($data->foto_siswa)
                            <img src="{{ 'uploads/siswa/'.$data->foto_siswa }}" height="90" width="70" >
                            @else
                            <a href="" class="btn btn-danger">Tambahkan Foto</a>
                            @endif
                        </td>
                        <td>{{ $data->tmpt_lahir_siswa }}</td>
                        <td>{{  \Carbon\Carbon::parse($data->tgl_lahir_siswa)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{ $data->jenis_kelamin }}</td>
                        <td>{{ $data->no_ortu }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  


</body>
</html>