<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
      @foreach ($banner as $index => $bnr)
      <div class="carousel-item @if($index == 0) active @endif">
          <img src="{{ asset('uploads/banner/' . $bnr->gambar_banner) }}" class="d-block w-100" alt="..." loading="lazy">
          <div class="carousel-caption">
              <h5 class="caption-h">{{ $bnr->judul_banner1 }}<br>{{ $bnr->judul_banner2 }}<span class="carousel-brand">{{ $bnr->judul_banner3 }}</span></h5>
              <a href="" class="btn btn-caption">KONTAK KAMI</a>
          </div>
      </div>
      @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
  </button>
</div>
