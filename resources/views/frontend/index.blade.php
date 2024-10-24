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
      .a-s {
    color: inherit;
    text-decoration: none;
}
.a-s:hover {
    color: inherit; 
    text-decoration: none; 
}
  .card-s{
    transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s 
    -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
  }
  .card-s:hover{
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
  }
  .card-img-top {
  height: 250px; /* Set a fixed height for the images */
  object-fit: cover; /* Ensures the image fits nicely within the specified height without distortion */
}
  .title-s{
        text-transform: capitalize;
        font-size: 12px;
        
      }
</style>

     <!-- ICON -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

     <!-- FONT AWASOME -->
      <link rel="stylesheet" href="assets/font/css/fontawesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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
              <div class="about" id="">
                  <h4 class="about-brand text-center fw-bold mb-3">TENTANG PRAKERIN</h4>
                  <div class="row d-flex justify-content-center align-items-center">
                      @foreach ($tentang as $tng)
                      <div class="col-6 ">
                        <img src="{{ asset('uploads/tentang/'. $tng->gambar_tentang) }}" class="img-about  mt-3" loading="lazy" >
                      
                      </div>
                      <div class="col-6">
                          <p class="about-text ">{{ $tng->text_tentang }}
                          </p>
                      </div>
                      @endforeach
                      <div class="container d-flex justify-content-center align-items-center">
                        <div class="info-panel shadow-lg col-12 rounded-2">
                            <div class="row text-center">
                                <div class="col-12 col-md-6 mb-3 d-flex align-items-center justify-content-center">
                                    <img src="assets/img/icon3.png" class="icon-panel" alt="">
                                    <h6 class="text-panel ml-2">teknik & bisnis sepeda motor</h6>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex align-items-center justify-content-center">
                                    <img src="assets/img/icon4.png" class="icon-panel" alt="">
                                    <h6 class="text-panel ml-2">teknik komputer dan jaringan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  </div>
              </div>
          </div>
          <!-- BERITA -->
          <div class="berita pt-2">
              <h3 class="berita-brand pt-2 text-center fw-bold text-white ">BERITA</h3>
              <div class="container py-4 ">
                <div class="row g-4 ">
                  @foreach ($berita as $brt)
                  <div class="col-md-4 col-sm-12">
                    <a href="{{ route('showBerita',$brt->id) }}" class="a-s">
                    <div class="card card-s pb-3 mb-3" style="width: 100%;">
                      <div class="card-body">
                        <img src="{{ asset('uploads/berita/'. $brt->cover_berita) }}"  class="card-img-top"  loading="lazy" >
                        <h6 class="card-title title-s mt-2"><strong>{{ $brt->judul_berita }} </strong></h6>
                        <p class="card-text"><small class="text-muted">{{ $brt->created_at->format('d M Y') }}</small></p>
                      </small><i class='bx bxs-show d-flex flex-end'>{{ $brt->views }}</i></p>
                      </div>
                    </div>
                  </a>
                  </div>
                  @endforeach
                </div>
                  <div class="d-flex justify-content-center align-items-center">
                      <a href="/berita-terbaru" class="btn btn-s text-white">LIHAT SELENGKAPNYA</a>
                  </div>
              </div>
              <img src="assets/img/wave.svg" alt="">
            </div>
              <!-- KERJA SAMA -->
              <div class="kerja-sama" id="kerja-sama">
                  <div class="container">
                    <h2 class="kerjasama-brand fw-bold text-dark text-center">kerja sama</h2>
                    <span class="d-flex justify-content-center align-items-center"><img src="assets/img/icon5.png" width="60" class="mb-2" height="50" alt=""></span>

                    <div class="perusahaan">
                      <div class="row g-2">
                       @foreach ($collaborate as $no => $clb)
                       <div class="col-md-2 col-6">
                        <img src="{{ asset('uploads/kerjasama/'.$clb->logo_industri) }}" width="100%" height="70" loading="lazy" alt="">
                      </div>
                       @endforeach
                      </div>
                    </div>
                  </div>
              </div>

              <!-- GALERI -->
               <div class="galeri ">
                <img src="assets/img/wave (5).svg"  alt="">
                   <div class="container">
                    <h4 class="galeri-brand text-center">Yuk, Intip Serunya Kegiatan 
                      Prakerin SMKN 7 KENDAL di Sini!</h4>
                      <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-6 text-galeri">
                          <p>Hai guys! Pernah dengar Prakerin? Prakerin itu singkatan dari Praktek Kerja Industri, lho. Di SMK, Prakerin adalah kegiatan wajib yang bertujuan untuk memberikan pengalaman kerja nyata bagi para siswa. </p>
                          <p> Nah, di website SMK kita ini, kamu bisa menjelajahi Galeri Prakerin yang super keren! Di sini, kamu bakal nemuin berbagai cerita seru dan inspiratif dari pengalaman Prakerin kakak-kakak kelasmu.</p>
                          <a href="" class="btn btn-s">GALERI</a>
                        </div>
                        <div class="col-md-6 col-sm-6 box-background">
                          <div class="row g-2">
                            <div class="col-8">
                              <div class="box"></div>
                            </div>
                            <div class="col-4">
                              <div class="box"></div>
                            </div>
                            <div class="col-6">
                              <div class="box">
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="box"></div>
                            </div>
                            <div class="col-8">
                              <div class="box"></div>
                            </div>
                            <div class="col-4">
                              <div class="box"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                   </div>
               </div>
               <!-- VISIMISI -->
              @include('frontend.visi-misi')
                <!-- FOOTER -->
               @include('frontend.footer')
          </div> <!-- CONTAINER -->
       </main>
   
       
      
      <!-- JS BS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     
     <script src="{{ asset('/assets/public.js') }}"></script>


</body>
</html>