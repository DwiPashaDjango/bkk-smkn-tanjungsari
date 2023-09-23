<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .letterhead {
            color: #090909;
            text-align: center;
            padding: 20px;
        }

        .letterhead h1 {
            margin: 0;
            font-size: 24px;
        }

        .letterhead h2 {
            margin: 0;
            font-size: 20px;
        }

        .letterhead p {
            margin: 5px 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="letterhead">
        <h2>PEMERINTAH KABUPATEN LAMPUNG</h2>
        <h2>SEKOLAH MENEGAH KEJURUAN NEGRI</h2>
        <h1>SMKN Tanjung Sari</h1>
        <p>JL. Raya Kertosari No. 51 B, Kertosari Kec. Tanjung Sari Kab. Lampung Selatan Kode Pos : 35361</p>
        <p>Email : smkn1tjsari@gmail.com, NPSN : 10812412, Telepon: 08127971961</p>
    </div>

    <table>
        <tr>
            <th>Nama Lengkap</th>
            <th style="width: 5px">:</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <th style="width: 5px">:</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>NISN</th>
            <th style="width: 5px">:</th>
            <td>{{$user->nisn}}</td>
        </tr>
        <tr>
            <th>Tempat Tanggal Lahir</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->tmp_lahir}}, {{\Carbon\Carbon::parse($user->user_profile->tgl_lahir)->format('d F Y')}}</td>
        </tr>
        <tr>
            <th>Jurusan</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->jurusan->name}}</td>
        </tr>
        <tr>
            <th>Tahun Lulus</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->thn_lulus}}</td>
        </tr>
        <tr>
            <th>Status Karir</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->sts_karir}}</td>
        </tr>
        <tr>
            <th>Penghasilan</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->penghasilan ?? '-'}}</td>
        </tr>
        <tr>
            <th>Universitas</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->universitas ?? '-'}}</td>
        </tr>
        <tr>
            <th>No Telephone</th>
            <th style="width: 5px">:</th>
            <td>{{$user->user_profile->telp ?? '-'}}</td>
        </tr>
    </table>
</body>
</html>
