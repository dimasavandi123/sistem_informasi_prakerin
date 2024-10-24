
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Profil User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Nama : {{ auth()->user()->name }}</p>
            <p>Username : {{ auth()->user()->username }}</p>
            <p>Email : {{ auth()->user()->email }}</p>
            <p>Password : </p>
            @if (auth()->user()->role == 0)
                <p>Sebagi : Admin</p>
            @elseif(auth()->user()->role == 1)
            <p>Sebagi : Guru</p>
            @else
            <p>Sebagi : Siswa</p>    
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" class="btn btn-primary" href="">Ubah Profil</a>
        </div>
      </div>
    </div>
  </div>