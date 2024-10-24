@extends('admin.index')
@section('title','Kelas')
@section('content')
<main>
    
    <h1 class="title">Data User Siswa</h1>
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
            <a type="button" href="{{ route('siswa-user.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Data</a>
            <a type="button" class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
            <a type="button" class="btn btn-success"><i class='bx bxs-file-import' ></i>Import Excel</a>
          </div>
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
            <div class="scrol mt-3" style="overflow-x: auto;">
                <table class="table table-striped table-responsive ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Akses</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswaUser as $no => $item)
                            <tr>
                                <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                <th>{{ $no+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->role == 0)
                                    Admin
                                    @elseif ($item->role == 1)
                                    Guru
                                    @else
                                    Siswa
                                    @endif
                                </td>
                                <td>
                                    <a href="user/{{ $item->id }}" class="btn btn-{{ $item->status ? 'success' : 'danger' }}">
                                        {{ $item->status ? 'Aktif' : 'Non Aktif' }}
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('siswa-user.destroy',$item->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <div class="btn-group">
                                            <a href="{{ route('siswa-user.edit',$item->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
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
                                url : 'siswa-user/' + deleteid,
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