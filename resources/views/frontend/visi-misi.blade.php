<div class="visi-misi">
    <div class="container">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        @foreach ($visimisi as $vm)
        <div class="swiper-slide">
            <div class="row">
              <div class="col-6">
                <img src="{{ asset('uploads/visi-misi/'. $vm->gambar_visimisi) }}" class="visimisi-img" alt="">
              </div>
              <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="misi">
                  <h4 class="visi-title text-center fw-bold">{{ $vm->judul_visimisi }}</h4>
                  <img src="assets/img/img5.png" class="visi-icon" alt="">
                  <h2 class="visi-title-2 text-center fw-bold">"{{ $vm->slogan_visimisi }}"</h2>
                  <p class="visi-text text-center">{{ $vm->deskripsi_visimisi }}</p>
                  <div class="d-flex justify-content-center align-items-center">
                    <a href="" class="btn ">VISI MISI</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
         
          
          <!-- Tambahkan slide lainnya di sini jika diperlukan -->
        </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>