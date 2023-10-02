<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NISN',
            'Email',
            'Jurusan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Tahun Lulus',
            'Status Karir',
            'Perusahaan',
            'Penghasilan',
            'Universitas',
        ];
    }

    public function collection()
    {
        return User::with('user_profile')->where('roles', 'alumni')->where('email_verified_at', '!=', null)->get();
    }

    public function map($row): array
    {
        $no = 1;
        return [
            $no++,
            $row->name,
            $row->nisn,
            $row->email,
            $row->jurusan,
            $row->user_profile->tmp_lahir,
            Carbon::parse($row->user_profile->tgl_lahir)->format('d-F-Y'),
            $row->user_profile->thn_lulus,
            $row->user_profile->sts_karir,
            $row->user_profile->perusahaan,
            $row->user_profile->penghasilan,
            $row->user_profile->universitas
        ];
    }
}
