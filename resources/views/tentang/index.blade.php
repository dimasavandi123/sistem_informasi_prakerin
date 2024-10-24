@extends('admin.index')
@section('title','Tentang')
@section('content')
<main>
    
    <h1 class="title">Table Tentang</h1>
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
        @if (auth()->user()->role == 1)
            <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
                <a type="button" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
                <a type="button" class="btn btn-success"><i class='bx bxs-file-import' ></i>Import Excel</a>
            </div>
        @else
            <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">
                <a type="button" href="{{ route('tentang.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Data</a>
                <a type="button" href="" target="_blank" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
                <a type="button" class="btn btn-success"><i class='bx bxs-file-import' ></i>Import Excel</a>
            </div>    
        @endif
    </ul>
    
     <div class="card">
        <div class="card-body">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Maximal 1 foto dan 1 paragraph.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
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
                            <th>Gambar Tentang</th>
                            <th>Text Tentang</th>      
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tentang as $no => $tng)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $tng->id }}">
                                <th>{{ $no+1 }}</th>
                                <td>
                                    <img src="{{ asset('uploads/tentang/'. $tng->gambar_tentang) }}" height="90" width="100" class="mt-3" >
                                </td>
                                <td>{{ $tng->text_tentang }}</td>
                                <td>
                                    <form action="{{ route('tentang.destroy',$tng->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('tentang.edit',$tng->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
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