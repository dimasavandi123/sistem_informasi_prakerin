<navbar>
    <i class='bx bx-menu toggle-sidebar' style="color: white;" ></i>
    <form action="#">
        <div class="form-group">
            <input type="text" placeholder="Search..." name="q">
            <i class='bx bx-search icon text-dark' ></i>
        </div>
    </form>
    <a href="#" class="nav-link">
        <i class='bx bxs-bell icon' ></i>
        
    </a>
    <a href="#" class="nav-link">
        <i class='bx bxs-message-square-dots icon' ></i>
        
    </a>
    <span class="divider"></span>
    <div class="profile">
        <img src="{{ auth()->user()->foto_profil ? asset('uploads/userProfil/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" >
        <ul class="profile-link">
            <li><a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
            <li><a href="/logout" onclick="return confirm('Apakah anda yakin ingin logout?') "><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
        </ul>
    </div>
    <!-- Button trigger modal -->

  <!-- Modal -->
  
</navbar>