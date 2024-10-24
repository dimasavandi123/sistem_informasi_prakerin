<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @media screen and (max-width: 768px) {
            .auth-s {
                margin-bottom: 50px;
            }
            .text-2 {
                margin-bottom: 30px;
            }
        }
        .eye-icon {
            cursor: pointer;
        }
    </style>
    <title>Halaman Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            @if (session('success'))
                <div class="alert alert-success d-flex justify-content-center align-items-center" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger " role="alert">
                    <h3 class="alert-heading ">Error</h3>
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>{{ $error }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
            <div class="auth-s col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <!-- <img src="images/1.png" class="img-fluid" style="width: 250px;"> -->
                </div>
                <p class="text text-white text-center fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Selamat Datang Di Sistem Manajemen Prakerin</p>
                <small class="text-white text-2 text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Silahkan Login Terlebih Dahulu</small>
            </div>       
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Masukan</h2>
                        <p>Username & Password Yang Sesuai</p>
                    </div>
                    <form action="/auth/login" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password">
                            <span class="input-group-text eye-icon" onclick="togglePassword()">
                                <i class='bx bx-hide' id="eyeIcon"></i>
                            </span>
                        </div>
                        
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Login</button>
                        </div>
                    </form>
                    <div class="row text-center">
                        <small><a href="/">Kembali Ke Halaman Depan</a></small>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.replace('bx-hide', 'bx-show'); // Ganti ikon
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.replace('bx-show', 'bx-hide'); // Ganti kembali ikon
            }
        }
    </script>
</body>
</html>
