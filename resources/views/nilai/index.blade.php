@extends('admin.index')

@section('title', 'Daftar Nilai')

@section('content')
<main>
    <h1 class="title">Daftar Nilai</h1>
    <ul class="breadcrumbs">
        <li><a href="#">Table</a></li>
        <li class="divider">/</li>
        <li><a href="#" class="active">Nilai</a></li>
    </ul>

    <div class="card">
        <div class="card-body">
            <h3>Filter Nilai Berdasarkan Kelas</h3>
            <form action="{{ route('nilai.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="kelas_id" id="kelas" class="form-control">
                                <option value="">Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ request('kelas_id') == $kls->id ? 'selected' : '' }}>
                                        {{ $kls->kelas_jurusan_siswa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <button class="btn btn-success" type="button" onclick="window.location='{{ route('nilai.index') }}'">Reset</button>
                    </div>
                </div>
            </form>

            <h3 class="mt-5">Rata-rata Nilai Siswa per Mata Pelajaran</h3>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Rata-rata Mata Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiRataRata as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['username'] }}</td>
                            <td>{{ $data['kelas'] }}</td>
                            <td>{{ number_format($data['rata_rata'], 2) }}</td>
                            <td>
                                <a href="{{ route('nilai.show', ['userId' => $data['user_id']]) }}" class="btn btn-info"><i class='bx bx-show text-white'></i></a>
                                <a href="{{ route('nilai.cetakNilai', ['userId' => $data['user_id']]) }}" class="btn btn-danger" target="_blank"><i class='bx bxs-file-pdf' ></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
