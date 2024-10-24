@extends('admin.index')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('title','Instruktur Dudi')
@section('content')
<main>
    <h1 class="title">Form Instruktur Dudi</h1>
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
            <a type="button" href="{{ route('instruktur-dudi.index') }}" class="btn btn-primary"><i class='bx bx-arrow-back'></i>Kembali</a>
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
            <form action="{{ route('instruktur-dudi.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="">Nama Instruktur</label>
                <input type="text" placeholder="Pak Nugroho" name="nama_instruktur">
            </div>
            <div class="form-group mb-3">
                <label for="">Tempat Dudi</label>
                <select name="prakerin_id" id="prakerin">
                    <option value="">--Pilih--</option>
                        @foreach ($prakerin as $tempat)
                            <option value="{{ $tempat->id }}">{{ $tempat->tempatPrakerin->nama_dudi }}</option>
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
                <label for="">Kelas Siswa</label>
                <input type="text" name="kelas_jurusan_siswa" id="kelas_jurusan_siswa" readonly>
            </div>
            <input type="hidden" name="kelas_id" readonly id="kelas_id">
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
    $(document).ready(function () {
        $.ajaxSetup({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

         $('#prakerin').on('change', function () {
            var prakerin_id = $(this).val();

            $.ajax({
                type: 'POST',
                url: "{{ route('getTempat') }}",
                data: {
                    prakerin_id: prakerin_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#siswa').html(response.options);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#siswa').on('change', function() {
                let siswa_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("getDetail") }}',
                    data: { siswa_id: siswa_id },
                    success: function(response) {
                        $('#kelas_jurusan_siswa').val(response.kelas_jurusan_siswa);
                        $('#kelas_id').val(response.kelas_id);
                    }
                });
         });
     });
</script>

</main>
@endsection