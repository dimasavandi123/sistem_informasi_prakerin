@extends('admin.index')

@section('title', 'Detail Nilai')

@section('content')
<main>
    <h1 class="title">Detail Nilai</h1>
    <ul class="breadcrumbs">
        <li><a href="{{ route('nilai.index') }}">Daftar Nilai</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Detail</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h3>Detail Nilai Siswa</h3>
    
            @if ($nilaiLengkap->isNotEmpty())
                <div class="mb-3">
                    @foreach ($nilaiLengkap->unique('users_id') as $jawaban)
                        <h4>Nama Siswa: {{ $jawaban->users->name ?? 'N/A' }}</h4>
                    @endforeach
                </div>

                <h4>Rata-rata Nilai Berdasarkan Mapel</h4>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gurumapel</th>
                            <th>Rata-rata Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiRataRataMapel as $gurumapelId => $rataRata)
                            @php
                                $gurumapel = App\Models\Gurumapel::find($gurumapelId);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gurumapel->nama_mapel ?? 'N/A' }}</td>
                                <td>{{ number_format($rataRata, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tugas</th>
                            <th>Tugas Ke</th>
                            <th>Nilai</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiLengkap as $jawabanSiswa)
                            @foreach ($jawabanSiswa->nilai as $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jawabanSiswa->tugas->nama_tugas ?? 'N/A' }}</td>
                                    <td>{{ $jawabanSiswa->tugas->tugas_ke }}</td>
                                    <td>{{ $nilai->nilai }}</td>
                                  
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            @else
                <p>Data tidak ditemukan.</p>
            @endif

            <a href="{{ route('nilai.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Nilai</a>
        </div>
    </div>
</main>
@endsection
