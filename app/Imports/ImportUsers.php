<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUsers implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!empty($row['nisn'])) {
            return new User([
                'name' => $row['name'],
                'roles' => 'alumni',
                'nisn' => (int)$row['nisn'],
                'jurusan' => $row['jurusan'],
                'password' => Hash::make($row['password'])
            ]);
        }
    }
}
