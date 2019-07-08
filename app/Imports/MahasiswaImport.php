<?php

namespace App\Imports;

use App\mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Concerns\WithMappedCells;

class MahasiswaImport implements WithStartRow, ToModel 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // public function mapping():array{
    //    return [
    //         'id_smester' => 'E0'
    //    ];
    // }

    public function model(array $row)
    {
        return $row;

    // return  new mahasiswa([
    //         'nim' => $row[1],
    //         'nama' => $row[2],
    //         'kelas' => $row[3]
    //     ]);
    }

    // public function startRow(): int{
    //     return 0;
    // }

    
}
