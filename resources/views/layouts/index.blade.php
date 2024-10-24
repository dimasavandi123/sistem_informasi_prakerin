permasalahnnya yaitu saat saya (user a) ingin show jawaban tugas tersebut tapi kenapa jawaban user b juga ikut tampil

jawabanController 
public function show($id)
{
    $kelas = Kelas::all();
    $gurumapel = Gurumapel::all();
    $tugas = Tugas::find($id);
    $jawaban = Jawaban::where('tugas_id',$id)->get();
    return view('tugas.answer', compact('gurumapel','tugas','kelas','jawaban'));
}

tugas.answer 
<div class="mt-3" style="overflow-x: auto;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Jawaban {{ auth()->user()->username }} <div class="spinner-grow text-success spinner-grow-sm" role="status">
            <span class="visually-hidden">Loading...</span>
          </div></a>
        </li>
      </ul>
      <div class="card mt-3">
        <div class="card-header card-header-s">
          {{ $tugas->nama_tugas }} - {{ $tugas->gurumapel->nama_mapel }} - SOAL
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>{!! $tugas->tugas_siswa !!}</p>
          </blockquote>
        </div>
      </div>
</div> 
<div class="mt-3">
    <a href="" class="btn btn-danger btn-sm float-end"><i class='bx bxs-file-pdf' ></i></a>
    <h5 class="fw-bold">Jawaban</h5>
    <div class="card">
        <div class="card-body bg-light">
            @foreach ($jawaban as $jawab)
                <h6>Nama : {{ auth()->user()->username }}</h6>
                <h6>Kelas : {{ $jawab->kelas->kelas_jurusan_siswa }}</h6> 
                <p>{!! $jawab->jawaban !!}</p>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>    a