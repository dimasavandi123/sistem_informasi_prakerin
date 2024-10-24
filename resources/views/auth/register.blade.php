<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <title>Halaman Login</title>
</head>
<body>


     <div class="container d-flex justify-content-center align-items-center min-vh-100">
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
        @if (count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <h3 class="alert-heading">Error</h3>
                @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                @endforeach
            </div>
        @endif
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box bg-warning">
           <div class="featured-image mb-3">
            <!-- <img src="images/1.png" class="img-fluid" style="width: 250px;"> -->
           </div>
           <p class="text-white text-center fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Selamat Datang Di Sistem Manajemen Prakerin</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Buatlah Akun Terlebih Dahulu</small>
       </div>       
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Isi Form Register</h2>
                     <p>Jangan pernah untuk memberikan password ke siapa pun</p>
                </div>
                <form action="/auth/register" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Nama" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username">
                    </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email">
                </div>
                <div class="input-group mb-1">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password">
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                    </div> -->
                    <!-- <div class="forgot">
                        <small><a href="#">Forgot Password?</a></small>
                    </div> -->
                </div>
                <div class="input-group mb-3 d-grid gap-2">
                    <button class="btn btn-primary" type="submit" >Register</button>
                    <a href="/login" class="btn btn-danger">Kembali Ke Halaman Login</a>
                </div>
                </form>
                <!-- <div class="input-group mb-3">
                    <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                </div> -->
          </div>
       </div> 

      </div>
    </div>

</body>
</html>