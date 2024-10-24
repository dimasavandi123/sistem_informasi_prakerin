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
      .card-s {
          transition: .3s transform cubic-bezier(.155,1.105,.295,1.12), .3s box-shadow, .3s;
          min-height: 400px; /* Atur tinggi minimum untuk card */
      }
  
      .card-body {
          min-height: 150px; /* Atur tinggi minimum untuk konten di dalam card */
      }
  
      .card-s:hover {
          transform: scale(1.05);
          box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
      }
  
      .title-s {
          text-transform: capitalize;
      }
  
      .a-s {
          color: inherit;
          text-decoration: none;
      }
  
      .a-s:hover {
          color: inherit;
          text-decoration: none;
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
      @include('frontend.banner')
     
      
      <!-- CONTENT -->
       <main id="content" class="content">
      
          <!-- BERITA -->
          <div class="berita pt-2">
              <h3 class="berita-brand pt-2 text-center fw-bold text-white ">BERITA</h3>
              <div class="container py-4 ">
                  <span class="text-white mb-2"><em>TERBARU : </em></span>
                <div class="row g-4 ">
                  <div class="col-md-3 col-sm-12">
                    <a href="{{ route('showBerita',$brt->id) }}" class="a-s">
                    <div class="card card-s pb-3 mb-3" style="width: 100%;">
                      <div class="card-body">
                        <img src="{{ asset('uploads/berita/'. $brt->cover_berita) }}"  class="card-img-top" height="250px"  loading="lazy"  style="object-fit: cover">
                        <h5 class="card-title title-s mt-2" ><strong>{{ $brt->judul_berita }} </strong></h5>
                        <p class="card-text"><small class="text-muted">{{ $brt->created_at->format('d M Y') }}</small><i class='bx bxs-show d-flex flex-end'>{{ $brt->views }}</i></p>
           
                      </div>
                    </div>
                  </a>
                  </div>
                  @endforeach
                </div>
                <div class="paginate">
                  {{ $berita->links() }}
                </div>
              </div>
              <img src="assets/img/wave.svg" alt="">
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