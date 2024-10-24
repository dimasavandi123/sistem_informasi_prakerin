<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/public.css') }}">

     <!-- ICON -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

     <!-- FONT AWASOME -->
      <link rel="stylesheet" href="assets/font/css/fontawesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <title>SISTEM INFORMASI PRAKERIN</title>
</head>
<body>
    <!-- NAVBAR -->
    @include('frontend.navbar')


      <!-- CAROUSEL -->
      @include('frontend.banner')
     
      
      <!-- CONTENT -->
       <main id="content" class="content">
          <div class="container">
            <!-- ABOUT -->
             
          </div>
          <!-- BERITA -->

              <!-- KERJA SAMA -->
              <div class="kerja-sama mt-3" id="kerja-sama">
                  <div class="container">
                    <h2 class="kerjasama-brand fw-bold text-dark text-center">kerja sama </h2>
                    <span class="d-flex justify-content-center align-items-center"><img src="assets/img/icon5.png" width="60" class="mb-2" height="50" alt=""></span>

                    <p>Hubungan Industri SMKN 7 KENDAL menjalin banyak kerjasama dengan pihak eksternal yang dapat mendukung pengembangan siswa-siswi kami. Kerjasama yang terjalin meliputi kerjasama dengan perguruan tinggi dan Dunia Industri / Duia Usaha (DU / DI). </p>
                    <p>Jurusan:</p>
                    <ol type="1">
                        <li>TBSM</li>
                        <li>TKJ</li>
                    </ol>
                    <h6 class="text-center fw-bold bg-dark p-2 text-white">DAFTAR PERUSAHAAN / INDUSTRI </h6>
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Industri</th>
                                <th>Logo Industri</th>
                                <th>Jurusan Sekolah</th>                            
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collaborate as $no => $clb)
                                <tr>
                                 
                                    <th>{{ $no+1 }}</th>
                                    <td>{{ $clb->nama_industri }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/kerjasama/'. $clb->logo_industri) }}" height="90" width="100" class="mt-3" >
                                    </td>
                                    <td>{{ $clb->jurusan_sekolah }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                  </div>
              </div>

         
                <!-- FOOTER -->
                @include('frontend.footer')
          </div> <!-- CONTAINER -->
       </main>
   
       
      
      <!-- JS BS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
      <script src="{{ asset('/assets/public.js') }}"></script>
</body>
</html>