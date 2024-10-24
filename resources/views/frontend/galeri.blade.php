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

      <style>
        .content .galeri .col-galeri{

            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 10px;
        }
        .content .galeri .col-galeri .card{
          box-shadow: 5px 5px 8px 5px rgba(57, 57, 57, 0.1);
        }
         /* Responsif: tampilan untuk ukuran layar lebih kecil */
    @media (max-width: 1200px) {
        .content .galeri .col-galeri {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .content .galeri .col-galeri {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .content .galeri .col-galeri {
            grid-template-columns: 1fr;
        }
      }
      </style>
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
          </div>
              <!-- GALERI -->
               <div class="galeri bg-light">
                   <div class="container">
                    <h3 class="text-center text-seconday fw-bold pt-3">GALERI KEGIATAN TERBARU SMKN 7 KENDAL</h3>
                    <div class="col-galeri">
                    @foreach ($galery as $gry)
                      <div class="card pb-3 m-3" style="width: 100%;">
                          <div class="card-body">
                             <img src="{{ asset('uploads/galery/'. $gry->gambar_galery) }}"  class="card-img-top " loading="lazy"  height="200px" class="card-img-top img-fluid">
                            <p class="text-muted mt-2 text-center" style="text-transform: uppercase;">{{ $gry->judul_galery }} <i class='bx bx-heart'></i></p>
                          </div>
                      </div>
                      @endforeach
                      {{ $galery->links() }}
               </div>
            
              </nav>
               <!-- VISIMISI -->
            
                <!-- FOOTER -->
                @include('frontend.footer')
          </div> <!-- CONTAINER -->
       </main>
   
       
      
      <!-- JS BS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
      <script src="{{ asset('/assets/public.js') }}"></script>
</body>
</html>