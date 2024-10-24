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
              <div class="about" id="">
                  <h4 class="about-brand text-center fw-bold mb-3">TENTANG PRAKERIN</h4>
                  <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-6 ">
                      <img src="assets/img/banner3.jpg" class="img-about mb-4" alt="">
                    </div>
                      <div class="col-12">
                          <p class="">Prakerin atau Praktek Kerja Industri merupakan kegiatan pendidikan, pelatihan, dan pembelajaran bagi siswa SMK (Sekolah Menengah Kejuruan) yang dilakukan di dunia usaha atau dunia industri yang berkaitan dengan kompetensi siswa sesuai bidang yang digelutinya. Pada umumnya, sekolah akan mengupayakan terlaksananya program Prakerin SMK ini demi meningkatkan keterampilan siswa di bidangnya.
                          </p>
                      </div>
                     
                      <div class="col-12 mt-4">
                        <h4 class=" about-brand text-center fw-bold">MANFAAT PRAKERIN</h4>
                        <ol type="1">
                          <li>BAGI SEKOLAH</li>
                          <ul>
                            <li>Penyesuaian Kurikulum: Sekolah dapat menyesuaikan kurikulum mereka berdasarkan umpan balik dari industri mengenai keterampilan yang dibutuhkan.
                            </li>
                            <li>Kerjasama dengan Industri: Prakerin memperkuat hubungan antara sekolah dan dunia industri, membuka peluang untuk kolaborasi yang lebih luas.</li>
                          </ul>
                          <li>BAGI SISWA</li>
                          <ul>
                            <li>Pengalaman Langsung: Siswa mendapatkan kesempatan untuk mengalami dan memahami lingkungan kerja sesungguhnya.</li>
                            <li>Peningkatan Kepercayaan Diri: Dengan bekerja di industri, siswa merasa lebih percaya diri dengan keterampilan dan pengetahuan yang mereka miliki.</li>
                            <li>Jaringan Profesional: Siswa dapat membangun hubungan profesional yang dapat bermanfaat bagi karier mereka di masa depan.</li>
                          </ul>
                          <li>BAGI INDUSTRI</li>
                          <ul>
                            <li>Sumber Tenaga Kerja: Industri mendapatkan tenaga kerja tambahan yang dapat membantu dalam operasional mereka.
                            </li>
                            <li>CSR dan Branding: Partisipasi dalam Prakerin menunjukkan komitmen perusahaan terhadap pendidikan dan pengembangan generasi muda.</li>
                          </ul>
                        </ol>
                      </div>
                      <div class="col-12 mt-4">
                        <h4 class=" about-brand text-center fw-bold">LANDASAN HUKUM</h4>
                        <ol type="1">
                          <li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional.</li>
                          <li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan
                          </li>
                          <li>Peraturan Pemerintah Republik Indonesia Nomor 41 Tahun 2015 tentang Pembangunan Sumber Daya Industri.</li>
                          <li>Peraturan Presiden Republik Indonesia Nomor 87 Tahun 2017 tentang Penguatan Pendidikan Karakter.</li>
                          <li>Peraturan Menteri Perindustrian Nomor 03/M-IND/PER/1/2017 tentang Pedoman Pembinaan dan Pengembangan Sekolah Menengah Kejuruan Berbasis Kompetensi yang Link and Match dengan Industri.</li>
                          <li>Keputusan Direktur Jenderal Pendidikan Dasar dan Menengah Kemendikbud Nomor 4678/D/KEP/MK/2016 tentang Spektrum Keahlian Pendidikan Menengah Kejuruan.</li>
                          <li>Permendikbud 50 tahun 2020 tentang Praktik Kerja Lapangan bagi Peserta Didik.</li>
                        </ol>
                      </div>
                      <div class="col-12 mt-4">
                        <h4 class=" about-brand text-center fw-bold">TUJUAN</h4>
                        <ol type="1">
                          <li>Memberikan pengalaman kerja langsung (real) untuk menanamkan (internalize) iklim kerja positif yang berorientasi pada peduli mutu proses dan hasil kerja.</li>
                          <li>Menanamkan etos kerja yang tinggi bagi peserta didik untuk memasuki dunia kerja menghadapi tuntutan pasar kerja global. </li>
                          <li>Memenuhi hal-hal yang belum dipenuhi di sekolah  agar mencapai    kebutuhan standar kompetensi lulusan.</li>
                          <li>Mengaktualisasikan penyelenggaraan PKL antara SMK dan Institusi Pasangan (DUDI), memadukan secara sistematis dan sistemik program pendidikan di SMK dan program latihan di dunia kerja (DUDI). </li>
                        
                        </ol>
                      </div>
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
        
               
                <!-- FOOTER -->
                @include('frontend.footer')
          </div> <!-- CONTAINER -->
       </main>
   
       
      
      <!-- JS BS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
      <script src="{{ asset('/assets/public.js') }}"></script>
</body>
</html>