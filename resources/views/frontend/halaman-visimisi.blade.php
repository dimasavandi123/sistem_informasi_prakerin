<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS BS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/public.css') }}">
    <style>
 .visi-misi-section {
            background-color: #F4F4F4;
            padding: 50px 0;
        }
        .visi-misi-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease;
        }
        .visi-misi-card:hover {
            transform: translateY(-10px);
        }
        .visi-misi-card h3 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .visi-misi-card p, .visi-misi-card ul {
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .visi-misi-card ul {
            list-style-type: decimal;
            padding-left: 20px;
        }
        .visi-misi-card ul li {
            margin-bottom: 10px;
        }
        body{
          background-color: #F4F4F4;
        }

    </style>

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

     
      
      <!-- CONTENT -->
       
      
          <!-- VISI MISI -->
 <main class="content" id="content">
  <div class=" mt-5 pt-5">
    <h1 class="text-center">Visi dan Misi Prakerin SMKN 7 Kendal</h1>

    <div class="visi-misi-section">
      <div class="container">
          <div class="row">
              <!-- Visi Card -->
              <div class="col-md-6 mb-4">
                  <div class="visi-misi-card text-center">
                      <h3>Visi</h3>
                      <p>Menjadi lembaga pendidikan yang menghasilkan lulusan yang kompeten, kreatif, inovatif, dan berdaya saing tinggi di bidang teknologi dan rekayasa.</p>
                  </div>
              </div>

              <!-- Misi Card -->
              <div class="col-md-6 mb-4">
                  <div class="visi-misi-card">
                      <h3>Misi</h3>
                      <ul>
                          <li>Menyelenggarakan pendidikan dan pelatihan yang berbasis kompetensi sesuai dengan perkembangan teknologi.</li>
                          <li>Membangun kemitraan dengan dunia usaha dan dunia industri untuk mendukung implementasi pendidikan.</li>
                          <li>Mendorong pengembangan kreativitas dan inovasi peserta didik melalui kegiatan-kegiatan kewirausahaan.</li>
                          <li>Menyediakan lingkungan belajar yang kondusif untuk menumbuhkan karakter yang disiplin, jujur, dan tanggung jawab.</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @include('frontend.footer')
 </main>

   
       
      
      <!-- JS BS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
      <script src="{{ asset('/assets/public.js') }}"></script>
</body>
</html>