@extends('admin.index')
@section('title','Prakerin')
@section('content')
<main>
    
    <h1 class="title">Data Prakerin Siswa</h1>
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
            <a type="button" href="{{ route('prakerin.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Data</a>
            <a type="button" href="{{ route('pdfprakerin') }}" target="_blank" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class='bx bxs-file-import' >Import Excel</i>
              </button>
          </div>
           <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/importPrakerin" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="file" name="file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>    
    </ul>

    <form action="{{ route('prakerin.index') }}" method="GET">
        <div class="row">
            <div class="col-md-4">
                <select name="kelas_filter" id="kelas_filter" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $item)
                        <option value="{{ $item->id }}" {{ request('kelas_filter') == $item->id ? 'selected' : '' }}>{{ $item->kelas_jurusan_siswa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button class="btn btn-success"  type="button" onclick="window.location='{{ route ('prakerin.index') }}'">Reset</button>
            </div>
        </div>
    </form>
    
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
            <div class="scrol mt-3" style="overflow-x: auto;">
                <table class="table table-striped table-responsive ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas </th>
                            <th>NIS</th>
                            <th>Guru Pembimbing</th>
                            <th>Tempat Prakerin</th>
                            <th>Pimpinan Dudi</th>
                            <th>Alamat Dudi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prakerin as $no => $pkl)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $pkl->id }}">
                                <th>{{ $no+1 }}</th>
                                <td>{{ $pkl->siswa->nama_siswa }}</td>
                                <td>{{ $pkl->kelas->kelas_jurusan_siswa }}</td>
                                <td>{{ $pkl->siswa->nis_siswa }}</td>
                                <td>{{ $pkl->gurumapel->nama_guru_mapel }}</td>
                                <td>{{ $pkl->tempatPrakerin->nama_dudi }}</td>
                                <td>{{ $pkl->nama_pimpinan }}</td>
                                <td>{{ $pkl->alamat_dudi }}</td>
                                <td>
                                    <form action="{{ route('prakerin.destroy',$pkl->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <div class="btn-group">
                                            <a href="{{ route('prakerin.edit',$pkl->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
                                            <button class="btn btn-danger btn-sm btndelete"><i class='bx bxs-trash'></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
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
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            id : deleteid,
                        };
                             $.ajax({
                                type : "DELETE",
                                url : 'prakerin/' + deleteid,
                                data: data,
                                success: function(response){
                                    swal(response.success,{
                                    icon: "success",
                                })
                                    .then((result)=>{
                                        location.reload();
                                    });
                            }
                        });
                    }else{
                        swal(response.error,{
                            icon: "error",
                        });
                    }
                });

            });
    });
</script>
@endsection