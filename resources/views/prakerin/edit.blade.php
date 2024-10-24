@extends('admin.index')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('title','Prakerin')
@section('content')
<main>
    <h1 class="title">Update Prakerin</h1>
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
                @if ($errors->any())
                    <div class="alert alert-danger " role="alert">
                        <h3 class="alert-heading ">Error</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form action="{{ route('prakerin.update',$prakerin->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group mb-3">
                <label for="gurupem">Guru Pembimbing</label>
                <select name="gurupem_id" id="gurupem" class="form-control">
                    @foreach ($gurupem as $guru)
                        <option value="{{ $guru->id }}" {{ $prakerin->gurupem_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="siswa">Nama Siswa</label>
                <select name="siswa_id" id="siswa" class="form-control">
                    @foreach ($siswa as $sw)
                        <option value="{{ $sw->id }}" {{ $prakerin->siswa_id == $sw->id ? 'selected' : '' }}>{{ $sw->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="kelas_jurusan_siswa">Kelas</label>
                <input type="text" id="kelas_jurusan_siswa" name="kelas_jurusan_siswa" readonly value="{{ $prakerin->siswa->kelas->kelas_jurusan_siswa }}">
            </div>
            <div class="form-group mb-3">
                <label for="nis_siswa">NIS Siswa</label>
                <input type="text" id="nis_siswa" name="nis_siswa" readonly value="{{ $prakerin->siswa->nis_siswa }}">
            </div>
            <div class="form-group mb-3">
                <label for="tempatPrakerin">Tempat Prakerin</label>
                <select name="tempatPrakerin_id" id="tempatPrakerin" class="form-control">
                    @foreach ($tempatPrakerin as $tmpt)
                        <option value="{{ $tmpt->id }}" {{ $prakerin->tempat_prakerin_id == $tmpt->id ? 'selected' : '' }}>{{ $tmpt->nama_dudi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="nama_pimpinan">Nama Pimpinan</label>
                <input type="text" id="nama_pimpinan" name="nama_pimpinan" readonly value="{{ $prakerin->tempatPrakerin->nama_pimpinan }}">
            </div>
            <div class="form-group mb-3">
                <label for="alamat_dudi">Alamat Dudi</label>
                <input type="text" id="alamat_dudi" name="alamat_dudi" readonly value="{{ $prakerin->tempatPrakerin->alamat_dudi }}">
            </div>
            <input type="hidden" id="kelas_id" name="kelas_id" value="{{ $prakerin->kelas_id }}">
            <button type="submit" class="btn btn-success"><i class='bx bxs-save'></i>Update Data</button>
            </form>
        </div>
    </div> 

    <!-- FOOTER -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             $('#gurupem').on('change', function() {
             let gurupem_id = $(this).val();
             $.ajax({
                type: 'POST',
                url: '{{ route("getSiswaGuru") }}',
                 data: { gurupem_id: gurupem_id },
                 success: function(response) {
                    $('#siswa').html(response.options);   
                    $('#nis_siswa').val('');
                    $('#kelas_jurusan_siswa').val('');
                    $('#kelas_id').val('');
                 }
            });
         });

         $('#siswa').on('change', function() {
                let siswa_id = $(this).val();
                $.ajax({
                type: 'POST',
                url: '{{ route("getDetailSiswa") }}',
                data: { siswa_id: siswa_id },
            
                success: function(response) {
                $('#nis_siswa').val(response.nis_siswa);
                $('#kelas_jurusan_siswa').val(response.kelas_jurusan_siswa);
                $('#kelas_id').val(response.kelas_id);
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
