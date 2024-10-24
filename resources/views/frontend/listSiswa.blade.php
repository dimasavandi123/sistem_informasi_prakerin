<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- CSS Khusus -->
    <link rel="stylesheet" href="{{ asset('/assets/public.css') }}">

    <!-- Boxicons Icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <title>SISTEM INFORMASI PRAKERIN</title>

    <style>
        /* Styling tabel */
        .table-striped {
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        thead {
            background-color: #343a40;
            color: white;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInTable 1s forwards;
        }

        thead th {
            padding: 12px;
            text-align: center;
        }

        tbody tr {
            background-color: #f8f9fa;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInTable 1s forwards;
            animation-delay: 0.5s;
        }

        tbody tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.3s ease;
            transform: scale(1.02);
        }

        td {
            padding: 12px;
            text-align: center;
        }

        /* Animasi */
        @keyframes fadeInTable {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h3.h-list {
            margin-bottom: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    @include('frontend.navbar')

    <!-- CAROUSEL -->
    @include('frontend.banner')
     
    <!-- CONTENT -->
    <main id="content" class="content">
        <div class="container">
            <!-- LIST DETAIL-->
            <div class="list-siswa mt-3"> 
                <div class="container">
                    <h3 class="h-list text-center">DAFTAR SISWA PRAKERIN SMKN 7 KENDAL</h3>
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tempat Dudi</th>
                                <th>Sisa Kuota</th>
                                <th>Daftar Siswa</th>
                                <th>Pembimbing Sekolah</th>
                                <th>Jurusan</th>
                                <th>Alamat Dudi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($tempatPrakerin as $no => $pkl)
                               <tr>
                                <th>{{ $no +1 }}</th>
                                <td>{{ $pkl->nama_dudi }}</td>
                                <td>
                                  @if($pkl->sisa_kuota == 0)
                                      <span class="badge bg-danger text-light">Penuh</span>
                                  @else
                                      <span class="badge bg-info text-dark">{{ $pkl->sisa_kuota }}</span>
                                  @endif
                                 </td>
                                 <td>
                                  @if($pkl->prakerin->count() > 0)
                                      <ul>
                                          @foreach($pkl->prakerin as $prakerin)
                                              <li type="1">{{ $prakerin->siswa->nama_siswa }}</li>
                                          @endforeach
                                      </ul>
                                  @else
                                      <span class="text-muted">Belum ada siswa</span>
                                  @endif
                              </td>
                              <td>
                                @if($pkl->prakerin->count() > 0)
                                    @php
                                        $uniqueGurus = []; // Array untuk menyimpan nama guru unik
                                    @endphp
                                    @foreach($pkl->prakerin as $prakerin)
                                        @if(!in_array($prakerin->gurumapel->nama_guru_mapel, $uniqueGurus))
                                            {{ $prakerin->gurumapel->nama_guru_mapel }}
                                            @php
                                                $uniqueGurus[] = $prakerin->gurumapel->nama_guru_mapel; // Tambahkan nama guru ke array
                                            @endphp
                                            @if(!$loop->last)
                                                <br> <!-- Tambahkan pemisah jika bukan guru terakhir -->
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-muted">Belum ada guru pembimbing</span>
                                @endif
                            </td>
                            
                              <td>
                                {{ $pkl->jurusan }}
                              </td>
                              <td>
                                {{ $pkl->alamat_dudi }}
                              </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        @include('frontend.footer')
    </main>
   

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/public.js') }}"></script>
</body>
</html>
