@extends('admin.index')
@section('title','Siswa')
@section('content')

<main>
    
    <h1 class="title">Data Siswa</h1>
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
   
        <div class="filter-group" style="margin-left: auto">
            <form action="{{ route('siswa.index') }}" method="GET">
              
                    <select name="kelas_id" id="kelas_id" class="border rounded-3" style="border: none;color: grey;padding: 2px;">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $kls)
                            <option value="{{ $kls->id }}" {{ $kls->id == $kelas_id ? 'selected' : '' }}>
                                {{ $kls->kelas_jurusan_siswa }}
                            </option>
                        @endforeach
                    </select>
                <button class="btn btn-outline-info btn-sm" type="submit">Filter</button>
                <button class="btn btn-outline-success btn-sm" type="button" onclick="window.location='{{ route ('siswa.index') }}'">Reset</button>
            </form>
        </div>
            <div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Basic mixed styles example">   
                <a type="button" href="{{ route('siswa.create') }}" class="btn btn-primary"><i class='bx bxs-folder-plus'></i>Tambah Data</a>
                <a type="button" href="{{ route('pdfsiswa',['kelas_id' => $kelas_id]) }}"  target="_blank"  class="btn btn-danger"><i class='bx bxs-file-pdf' ></i>Cetak PDF</a>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bxs-file-import' >Import Excel</i>
                  </button>
            </div>
  
  <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/importExcel" method="POST" enctype="multipart/form-data">
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
                            <th><input type="checkbox" id="checkbox_all_ids"></th>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas Siswa</th>
                            <th>NIS</th>
                            <th>Foto Siswa</th>
                            <th>Tmpt Lahir Siswa</th>
                            <th>Tgl Lahir Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomer Ortu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if ($siswa->count()>0)
                            @foreach ($siswa as $no =>  $data)
                            <tr>
                            <input type="hidden" class="delete_id" value="{{ $data->id }}">
                            <input type="hidden" class="nama_siswa" value="{{ $data->nama_siswa }}">
                            <td><input type="checkbox" name="checkbox" class="checkbox_ids" value="{{ $data->id }}"></td>
                            <th>{{ $no+1 }}</th>
                            <td>{{ $data->nama_siswa }}</td>
                            <td>{{ $data->kelas->kelas_jurusan_siswa }}</td>
                            <td>{{ $data->nis_siswa }}</td>
                            <td>
                                @if($data->foto_siswa && file_exists(public_path('uploads/siswa/' . $data->foto_siswa)))
                                    <img src="{{ asset('uploads/siswa/' . $data->foto_siswa) }}" height="90" width="70">
                                @else
                                    <form action="{{ route('uploadFoto', $data->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropa">Upload Image</button>

                                        {{-- MODAL --}}
                                        <div class="modal fade" id="staticBackdropa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Upload Foto Siswa</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <input type="file" name="foto_siswa">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $data->tmpt_lahir_siswa }}</td>
                            <td>{{  \Carbon\Carbon::parse($data->tgl_lahir_siswa)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->no_ortu }}</td>
                            <td >
                                <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group">
                                        <a href="{{ route('siswa.edit',$data->id) }}" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
                                        <button class="btn btn-danger btn-sm btndelete"><i class='bx bxs-trash'></i></button>
                                    </div>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" align="center">Tidak Ada Data</td>
                            </tr>
                            @endif
                    </tbody>
                </table>
                @if(!$kelas_id)
                    {{ $siswa->links() }}
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
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $('.btndelete').click(function(e){
                e.preventDefault();

                var deleteid = $(this).closest("tr").find('.delete_id').val();
                var namasiswa = $(this).closest("tr").find('.nama_siswa').val();
                swal({
                    title: "Apakah Yakin Ingin Menghapus Data ini?",
                    text: "Setelah dihapus data dari "+   namasiswa  +", tidak akan bisa dipulihkan kembali",
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
                            url : 'siswa/' + deleteid,
                            data: data,
                            success: function(response){
                                swal(response.status,{
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });

            });
    });
</script>
@endsection