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
        .card-s {
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        }
        .card-s:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }
        .h5-b {
            text-align: center;
            color: white;
            border-bottom: 1px white solid;
        }
        .card-title-s {
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }
        .h3-1 {
            text-transform: uppercase;
            color: white;
            background-color: #658ac2;
            padding: 15px;
            border-radius: 10px;  
            margin-bottom: 20px;
        }
        .btn-home {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #658ac2;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .btn-home:hover {
            background-color: #476a98;
            color: white;
        }
        /* General Styling for Mobile */
@media (max-width: 768px) {
    .card-img-top {
        height: auto; /* Adjust the height automatically for smaller screens */
    }
    .h3-1 {
        font-size: 1.5rem; /* Reduce font size for mobile */
        padding: 10px;
    }
    .btn-home {
        width: 40px;
        height: 40px;
    }
    .d-flex img {
        height: 150px; /* Reduce image size for mobile */
        width: 100%;
        object-fit: contain;
    }
}

/* General Styling for Larger Screens */
@media (min-width: 768px) {
    .h3-1 {
        font-size: 2rem;
        padding: 20px;
    }
    .card-img-top {
        height: 500px; /* Set a fixed height for larger screens */
    }
    .d-flex img {
        height: 250px; 
        width: 30%;
    }
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

    <!-- BUTTON KEMBALI KE HOME -->
    <a href="{{ url('/berita-terbaru') }}" class="btn-home">
      <i class='bx bx-log-out-circle'></i>
    </a>

    <!-- CONTENT -->
    <main id="content" class="content">
        <!-- BERITA -->
        <div class="berita pt-2">
            <h3 class="berita-brand pt-2 text-center fw-bold text-white">BERITA</h3>
            <div class="container py-4">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="h3-1">
                            <h3 class="fw-bold">{{ $berita->judul_berita }} <i class='bx bx-trending-up'></i><hr></h3>
                            <span class="fst-italic">{{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <img src="{{ asset('uploads/berita/'. $berita->cover_berita) }}" class="card-img-top" style="width: 100%; height: 500px; object-fit: cover;">
                                <hr>
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('uploads/berita/'. $berita->gambar_berita) }}" loading="lazy"  height="250px" width="30%" alt="" style="object-fit: inherit">
                                </div>
                                <p class="card-text mt-4">
                                    {!! $berita->artikel_berita !!}
                                </p>
                                <div class="d-flex p-2 rounded-3" style="background-color:#658ac2;color:white;">
                                    <i class='bx bxl-instagram me-2'></i>
                                    <i class='bx bxl-facebook-square me-2'></i>
                                    <i class='bx bxl-tiktok me-2'></i>
                                    <i class='bx bxl-youtube me-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <h5 class="h5-b">BERITA TERBARU LAINNYA</h5>
                      @foreach($berita_terbaru as $berita)
                      <div class="card mb-3" style="width: auto;">
                          <img src="{{ asset('uploads/berita/'. $berita->cover_berita) }}" class="card-img-top" loading="lazy"  style="width: 100%; height: 150px; object-fit: cover;">
                          <div class="card-body">
                              <a href="{{ url('showBerita/'.$berita->id) }}" class="card-title-s mt-2">{{ $berita->judul_berita }}</a>
                          </div>
                          <div class="card-footer text-muted text-center">
                              {{ $berita->created_at->format('d M Y') }}
                          </div>
                      </div>
                      @endforeach
                  </div>
                  
                </div>
            </div>
        </div>
    </main>

    <!-- JS BS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcX
