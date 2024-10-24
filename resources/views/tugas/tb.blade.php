@extends('admin.index')
@section('title','Tempat-Prakerin')
<style>
    ul .s {
    list-style-type: decimal;

}

</style>
@section('content')
<main>
    
    <h1 class="title">Table Tugas</h1>
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
        <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
            <a type="button" href="{{ route('tugas.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Tugas</a>
            <a type="button" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
            <a type="button" class="btn btn-success"><i class='bx bxs-file-import' ></i>Import Excel</a>
          </div>
    </ul>
    
     <div class="card ">
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

            <div class="mt-3" style="overflow: hidden;">
                <ul class="nav nav-tabs">
                    @if(auth()->user()->role == 2)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/tugas">Tugas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/dikerjakan">Dikerjakan</a>
                      </li>
                  
                    @else
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="/tb-tugas">TB Tugas</a>
                      </li>
                    <li class="nav-item">
                      <a class="nav-link " aria-current="page" href="/tugas">Tugas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/dikerjakan">Dikerjakan</a>
                    </li>
                    <form action="{{ route('tb-tugas') }}" method="GET">
                        
                            <select name="gurumapel_id" id="gurumapel_id" class="form-select ">
                                <option value="">--Pilih--</option>
                                @foreach($gurumapel as $mapel)
                                <option value="{{ $mapel->id }}" {{ $mapel->id == $gurumapel_id ? 'selected' : '' }}>
                                    {{ $mapel->nama_mapel }}
                                </option>
                                 @endforeach
                            </select>
                            <div class="mt-1 mb-1">
                                <button class="btn btn-outline-info btn-sm" type="submit">Filter</button>
                                <button class="btn btn-outline-success btn-sm" type="button" onclick="window.location='{{ route ('tb-tugas') }}'">Reset</button>
                            </div>
                      
                    </form>
                    @endif
                </ul>
                <table class="table table-striped table-responsive ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Mapel</th>
                        <th>Jumlah Soal</th>
                        <th>Tugas Ke</th>
                        <th>Aksi</th>    
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($tugas as $no => $tgs)
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $tgs->id }}">
                            <th>{{ $no+1 }}</th>
                            <td>{{ $tgs->nama_tugas }}</td>
                            <td>{{ $tgs->gurumapel->nama_mapel }}</td>
                            <td>
                               <span class="badge bg-warning">{{ $tgs->kolomTugas->count() }}</span>
                            </td>
                            <td><span class="badge bg-success">{{ $tgs->tugas_ke }}</span></td>
                            <td >
                                <form action="{{ route('tugas.destroy', $tgs->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('showAnswer',$tgs->id) }}" class="btn btn-info btn-sm"><i class='bx bx-show text-white'></i></a>
                                        <a href="{{ route('tugas.edit',$tgs->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
                                        <button class="btn btn-danger btn-sm btndelete"><i class='bx bxs-trash'></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach    
                </tbody>    
                </table> 
                @if (!$gurumapel_id)
                   {{ $tugas->links() }}
                @endif
            </div> 
        </div>
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
                text: "Setelah dihapus data tidak akan bisa dipulihkan kembali",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        id: deleteid,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: 'tugas/' + deleteid,
                        data: data,
                        success: function(response){
                            swal({
                                title: "Berhasil!",
                                text: response.success,
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(xhr){
                            swal({
                                title: "Gagal!",
                                text: "Terjadi kesalahan, data tidak ditemukan",
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