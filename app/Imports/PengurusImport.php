<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PengurusImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'as' => 'pengurus',
            'nama_pendek' => $row[1],
            'nama_panjang' => $row[2],
            'nim' => $row[3],
            'kelas' => $row[4],
            'alamat' => $row[5],
            'no_hp' => $row[6],
            'email' => $row[7],
            'password' => Hash::make($row[3]),
        ]);
    }
}
