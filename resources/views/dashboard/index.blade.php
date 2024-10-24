@extends('admin.index')
@section('title','Dashboard')
    
@section('content')
<main>
    @include('sweetalert::alert')
    <h1 class="title">Dashboard</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Home</a></li>
        <li class="divider">/</li>
        @if (Auth()->user()->role == 0)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Admin</a></li>
        @elseif(auth()->user()->role == 1)
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Guru</a></li>
        @else 
        <li><a href="#" class="active">Welcome {{ Auth()->user()->name }} Kamu Adalah Siswa</a></li>
        @endif
    </ul>
    <div class="info-data">
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Siswa</p>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
            <h2 class="label">{{ $jumlahSiswa }}</h2>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Guru Pembimbing</p>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
            <h2 class="label">{{ $gurupem }}</h2>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Instruktur Lapangan</p>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
            <h2 class="label">{{ $instruktur }}</h2>
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Tempat Prakerin</p>
                    <h3 class="label">{{ $tempatPrakerin }}</h3>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
           
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Kelas Siswa</p>
                    <h2 class="label">{{ $kelasSiswa }}</h2>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
           
        </div>
        <div class="card">
            <div class="head">
                <div>
                    <h2>Data</h2>
                    <p>Prakerin Siswa</p>
                    <h2 class="label">{{ $prakerin }}</h2>
                </div>
                <i class='bx bx-trending-up icon' ></i>
            </div>
            <hr style="padding: 2px;">
           
        </div>
    </div>
    <div class="data">
        <div class="content-data">
            <div class="seting-data">
                <div class="brand-seting">
                    <h3 class="fw-bold"><i class='bx bxs-cog'></i> Seting Akun</h3>
                </div>
                <div class="card mt-3">
                    <form action="{{ route('admin.updateUser', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ auth()->user()->foto_profil ? asset('uploads/userProfil/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" 
                                     alt="Foto Profil" 
                                     class="rounded-circle" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <p class="mt-2">Foto Profil</p>
                            </div>
                            <div class="input-group mb-3">
                     
                                <input type="file" name="foto_profil" class="form-control" id="foto_profil">
                            </div>
                      
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bxs-face'></i></span>
                                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" aria-label="Nama" style="background-color: #e0e0e0;">
                            </div>

                           
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bx-user-check'></i></span>
                                <input type="text" name="username" class="form-control" value="{{ auth()->user()->username }}" aria-label="Username" style="background-color: #e0e0e0;">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bx-envelope'></i></span>
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" aria-label="Email" style="background-color: #e0e0e0;">
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                              </svg>
                              
                             

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <strong>Silahkan Masukan Password Lama , Sebelum Mengubah Password</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>

                              <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bxs-key'></i></span>
                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Password Lama" aria-label="Password Lama" style="background-color: #e0e0e0;">
                                <span class="input-group-text">
                                    <i class="bx bx-show" id="toggleCurrentPassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bxs-key'></i></span>
                                <input type="password" id="new_password" name="password" class="form-control" placeholder="Password Baru" aria-label="Password Baru" style="background-color: #e0e0e0;">
                                <span class="input-group-text">
                                    <i class="bx bx-show" id="toggleNewPassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-secondary text-white"><i class='bx bxs-key'></i></span>
                                <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" style="background-color: #e0e0e0;">
                                <span class="input-group-text">
                                    <i class="bx bx-show" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                              

     
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"><i class='bx bx-save'></i> Ubah Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="nilai-dashboard p-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card bg-light">
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- <div class="card mt-3">
        <div class="card-body">
            <div class="form-group mb-3">
                <input type="text" placeholder="Type...">
                <button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
            </div>
            <div class="form-group mb-3" style="display: flex;flex-direction: column;">
                <label for="">Foto</label>
                <input type="file">
            </div>
            <div class="form-group mb-3" style="display: flex;flex-direction: column;">
                <label for="">Pilih</label>
                <select name="" id="" style="padding: 10px;background-color: #F1F0F6;border-radius: 10px;">
                    <option value="">1</option>
                </select>
            </div>
        </div>
    </div> -->
    <!-- TABLES -->
    <!-- <div class="mt-3">
        <table class="table table-responsive ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No</th>
                </tr>
            </thead>
        </table>
    </div> -->

    <!-- FOOTER -->
    

</main>
<script>
    // Toggle visibility for current password
document.getElementById('toggleCurrentPassword').addEventListener('click', function (e) {
    const currentPasswordInput = document.getElementById('current_password');
    const currentPasswordIcon = document.getElementById('toggleCurrentPassword');
    togglePasswordVisibility(currentPasswordInput, currentPasswordIcon);
});

// Toggle visibility for new password
document.getElementById('toggleNewPassword').addEventListener('click', function (e) {
    const newPasswordInput = document.getElementById('new_password');
    const newPasswordIcon = document.getElementById('toggleNewPassword');
    togglePasswordVisibility(newPasswordInput, newPasswordIcon);
});

// Toggle visibility for confirm password
document.getElementById('toggleConfirmPassword').addEventListener('click', function (e) {
    const confirmPasswordInput = document.getElementById('confirm_password');
    const confirmPasswordIcon = document.getElementById('toggleConfirmPassword');
    togglePasswordVisibility(confirmPasswordInput, confirmPasswordIcon);
});

// Function to toggle password visibility
function togglePasswordVisibility(inputElement, iconElement) {
    if (inputElement.type === "password") {
        inputElement.type = "text";
        iconElement.classList.remove('bx-show');
        iconElement.classList.add('bx-hide');
    } else {
        inputElement.type = "password";
        iconElement.classList.remove('bx-hide');
        iconElement.classList.add('bx-show');
    }
}

</script>
@endsection
