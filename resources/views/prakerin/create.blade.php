@extends('admin.index')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('title','Prakerin')
@section('content')
<main>
    <h1 class="title">Form Prakerin</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Create</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('prakerin.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
          </div>
    </ul>
    
    <div class="card mt-3">
        <div class="card-body">
            @if (session('success'))
                    <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                        <span>{{ session('success') }}</span>
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
            <form action="{{ route('prakerin.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="">Guru Pembimbing</label>
                <select name="gurumapel_id" id="gurumapel" class="form-control">
                    <option value="">--Pilih Guru--</option>
                    @foreach($gurumapel as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama_guru_mapel }}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form-group mb-3">
                <label for="">Nama Siswa</label>
                <select name="siswa_id" id="siswa">
                    <option value="">--Pilih Siswa--</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="">Kelas</label>
                <input type="text" id="kelas_jurusan_siswa" name="kelas_jurusan_siswa" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="">NIS SISWA</label>
                <input type="text" id="nis_siswa" name="nis_siswa" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="">Tempat Prakerin</label>
                <select name="tempatPrakerin_id" id="tempatPrakerin">
                    <option value="">--Pilih Tempat Prakerin--</option>
                    @foreach ($tempatPrakerin as $tmpt)
                        <option value="{{ $tmpt->id }}">{{ $tmpt->nama_dudi }}</option>
                        @endforeach
                 </select>
            </div>
            <div class="form-group mb-3">
                <label for="">Nama Pimpinan</label>
                <input type="text" id="nama_pimpinan" name="nama_pimpinan" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="">Alamat Dudi</label>
                <input type="text" id="alamat_dudi" name="alamat_dudi" readonly>
            </div>
            <div class="form-group mb-3">
                <input type="hidden" id="kelas_id" name="kelas_id">
            </div>
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Simpan Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#gurumapel').on('change', function() {
        let gurumapel_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '{{ route("getSiswaGuru") }}',
            data: { gurumapel_id: gurumapel_id },
            success: function(response) {
                $('#siswa').html(response.options);
            },
            error: function(xhr) {
                console.error(xhr); // Tambahkan penanganan kesalahan
            }
        });
    });

    $('#siswa').on('change', function() {
        let siswa_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '{{ route("getDetailSiswa") }}', // Pastikan rute ini ada
            data: { siswa_id: siswa_id },
            success: function(response) {
                $('#nis_siswa').val(response.nis_siswa);
                $('#kelas_jurusan_siswa').val(response.kelas_jurusan_siswa);
                $('#kelas_id').val(response.kelas_id);
            },
            error: function(xhr) {
                console.error(xhr); // Tambahkan penanganan kesalahan
            }
        });
    });

            $('#tempatPrakerin').on('change', function () {
                let id_tempatPrakerin = $(this).val();

                 $.ajax({
                     type: 'POST',
                      url: "{{ route('getPimpinan') }}",
                     data: {id_tempatPrakerin: id_tempatPrakerin},
                     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                     cache: false,

                     success: function (response) {
                        
                        $('#nama_pimpinan').val(response.nama_pimpinan);
                        $('#alamat_dudi').val(response.alamat_dudi);
                     },
                     
                     error: function (data) {
                        console.log('error', data);
                     }
                });
            }); 
        });
    </script>
</main>
@endsection