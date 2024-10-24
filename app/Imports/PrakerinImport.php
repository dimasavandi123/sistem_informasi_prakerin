<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Gurupem;
use App\Models\Prakerin;
use App\Models\tempatPrakerin;
use Maatwebsite\Excel\Concerns\ToModel;

class PrakerinImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $siswa = Siswa::where('nama_siswa',$row[0])->first();
        $kelas = Kelas::where('kelas_jurusan_siswa',$row[1])->first();
        $gurupem = Gurupem::where('nama_guru',$row[3])->first();
        $tempatPrakerin = tempatPrakerin::where('nama_dudi',$row[4])->first();
        return new Prakerin([
            'siswa_id' => $siswa->id,
            'kelas_id' => $kelas->id,
            'nis_siswa' => $row[2],
            'gurupem_id' => $gurupem->id,
            'tempatPrakerin_id' => $tempatPrakerin->id,
            'nama_pimpinan' => $row[5],
            'alamat_dudi' => $row[6],
        ]);
        
    }
}
