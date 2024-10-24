@extends('admin.index')
@section('title','Absen Siswa')
@section('content')
<main>
    
    <h1 class="title">Absen Siswa</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Table</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
       
    </ul>
    
     <div class="card">
        <div class="card-body">
           
            @if (session('success'))
            <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger d-flex justify-content-center align-items-center" role="alert">
                <span>{{ session('danger') }}</span>
            </div>
        @endif
        @if (count($errors)>0)
            <div class="alert alert-danger " role="alert">
                <h3 class="alert-heading ">Error</h3>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif

        <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
            <p>Keterangan Absen Diisi Sesuai Status Yg Dipilih <strong>Contoh:(Masuk: 07.30-16.00, Izin : Sakit)</strong> </p>
            <p>Foto Kegiatan <strong>Wajib Berlatarkan Tempat Prakerin/Foto Yg Sedang Dikerjakan</strong> </p>
            <p><strong>Abseni Akan Tetap Dipantau Oleh Guru Pembimbing</strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @if (!$sudahAbsen)
        <div class="d-grid gap-2 col-6 mx-auto mt-3">
            <button class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#absenModal123" > Absen  {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
        </div>
        @else
        <div class="alert alert-danger d-grid gap-2 col-10 mx-auto mt-3">
            <strong class="text-center">Anda sudah melakukan absen hari ini.</strong>
        </div>
        @endif
        

        {{-- MODAL ABSEN --}}
        <div class="modal fade" id="absenModal123" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="absenModalLabel123" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="absenModalLabel123">Form Absensi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Form Absensi -->
                  <form action="{{ route('absen-siswa.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group mb-3">
                        <label for="">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select">
                            <option value="">--Pilih Kelas--</option>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}">{{ $kls->kelas_jurusan_siswa }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group mb-3">
                          <label for="status" class="form-label">Status</label>
                          <select name="status" id="status" class="form-select" required>
                              <option value="">--Pilih--</option>
                              <option value="Masuk">Masuk</option>
                              <option value="Telat">Telat</option>
                              <option value="Izin">Izin</option>
                          </select>
                      </div>
                      
                      <div class="form-group mb-3">
                          <label for="keterangan" class="form-label">Keterangan</label>
                          <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                      </div>
                      
                      <div class="form-group mb-3">
                          <label for="foto_kegiatan" class="form-label">Foto Kegiatan</label>
                          <input type="file" name="foto_kegiatan" id="foto_kegiatan" class="form-control">
                      </div>
                      
                      <div class="form-group mb-3">
                          <label for="catatan_kegiatan" class="form-label">Catatan Kegiatan</label>
                          <textarea name="catatan_kegiatan" id="catatan_kegiatan" class="form-control"></textarea>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Submit Absensi</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          {{-- RIWAYAT --}}
         @if (Auth()->user()->role == 0 || Auth()->user()->role == 1  )
         <form action="{{ route('absen-siswa.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="kelas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}" {{ request('kelas_id') == $kls->id ? 'selected' : '' }}>
                                {{ $kls->kelas_jurusan_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" name="tanggal_absen" class="form-control" value="{{ request('tanggal_absen', \Carbon\Carbon::today()->format('Y-m-d')) }}" onchange="this.form.submit()">
                </div>
               <div class="col-md-4">
                <button class="btn btn-light" type="button" onclick="window.location='{{ route ('absen-siswa.index') }}'">Refresh</button>
               </div>
            </div>
        </form>
         @endif

         <form action="{{ route('rekap-absen-pdf') }}" method="GET" target="_blank">
            <button type="submit" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i></button>
        </form>
        
        
          <div class="scroll mt-3" style="overflow-x: auto;">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Foto Kegiatan</th>
                        <th>Catatan Kegiatan</th>
                        <th>Waktu Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @if($riwayat->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada riwayat absensi</td>
                        </tr>
                    @else
                        @foreach($riwayat as $no => $absen)
                        <tr>
                            <td>{{ $no+1}}</td>
                            <td> {{ $absen->user->name }}</td>
                            <td> {{ $absen->kelas->kelas_jurusan_siswa }}</td>
                            <td>{{ $absen->status }}</td>
                            <td>{{ $absen->keterangan }}</td>
                            <td>
                                @if($absen->foto_kegiatan)
                                    <img src="{{ asset('uploads/absen-siswa/' . $absen->foto_kegiatan) }}" alt="Foto Kegiatan" width="100">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>{{ $absen->catatan_kegiatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->waktu_absen)->isoFormat('dddd, D MMMM Y, H:mm') }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    <!-- FOOTER -->
    
</main>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $('.btndelete').click(function(e){
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();
            
            swal({
                title: "Apakah Yakin Ingin Menghapus Data ini?",
                text: "Setelah dihapus, data tidak akan bisa dipulihkan kembali.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        id: deleteid,
                    };

                    $.ajax({
                        type: "DELETE",
                        url: 'tentang/' + deleteid,
                        data: data,
                        success: function(response){
                            swal(response.status, {
                                icon: "success",
                            })
                            .then((result) => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            swal("Gagal menghapus data: " + xhr.responseJSON.status, {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });
    });
</script>



@endsection