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
    <title>DAFTAR TEMPAT DUDI | PDF</title>
</head>
<body>
    <h3 class="text-center mb-3">Laporan Daftar Tempat Dudi {{ date('Y-m-d') }}</h3>

    <table class="table table-striped table-responsive ">
        <thead>
            <tr>
                <th>No</th>
                <th>Tempat Prakerin</th>
                <th>Nama Pimpinan Dudi</th>
                <th>Alamat Dudi</th>
                <th>Jumlah Kuota</th>
                <th>Kuota Terisi</th>
                <th>Sisa Kuota</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach ($tempatPrakerin as $no =>  $hasil)
                <tr>
                
                    <th>{{ $no+1 }}</th>
                    <td>{{ $hasil->nama_dudi }}</td>
                    <td>{{ $hasil->nama_pimpinan }}</td>
                    <td>{{ $hasil->alamat_dudi }}</td>
                    <td>{{ $hasil->jmlh_kuota }}</td>
                    <td>{{ $hasil->kuota_terisi }}</td>
                    <td>{{ $hasil->sisa_kuota }}</td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
  


</body>
</html>