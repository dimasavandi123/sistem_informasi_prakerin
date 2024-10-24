<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kelas = Kelas::where('kelas_jurusan_siswa', trim($row[1]))->first();
        if (!$kelas) {
            // Tangani jika kelas tidak ditemukan, misalnya dengan return null atau membuat log error
            return null;
        }
        return new Siswa([
            'nama_siswa'  => $row[0],
            'kelas_id' =>  $kelas->id,
            'nis_siswa' => $row[2],
            'foto_siswa' => $row[3],
            'tmpt_lahir_siswa' => $row[4],
            'tgl_lahir_siswa' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['5']),
            'jenis_kelamin' => $row[6],
            'no_ortu' => $row[7],
        ]);
      
    }
}
