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
            /* padding: 20px; */
        }

        .letterhead h1 {
            margin: 0;
            font-size: 24px;
        }

        .letterhead h2 {
            margin: 0;
            font-size: 25px;
        }

        .letterhead p {
            margin: 5px 0;
            font-size: 8.5px
        }

        .table-letterhead td {
            border: none;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
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
    <table class="letterhead table-letterhead">
        <tr>
            <td width="25"><img src="{{$left_logo}}" width="100%"></td>
            <td width="75" style="text-align: center">
                <h2>Bursa Kerja Khusus (BKK)</h2>
                <h1>SMK NEGERI TANJUNGSARI</h1>
                <p>JL. Raya Kertosari No. 51 B, Kertosari Kec. Tanjung Sari Kab. Lampung Selatan Kode Pos : 35361</p>
                <p>Email : smkn1tjsari@gmail.com, NPSN : 10812412, Telepon: 08127971961</p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Foto</th>
            <th style="width: 5px; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;"><img src="{{$avatar}}" width="100" alt=""></td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Nama Lengkap</th>
            <th style="width: 5px; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->name}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Email</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->email}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">NISN</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->nisn}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Tempat Tanggal Lahir</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->tmp_lahir}}, {{\Carbon\Carbon::parse($user->user_profile->tgl_lahir)->format('d F Y')}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Jurusan</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->jurusan}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Tahun Lulus</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->thn_lulus}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Status Karir</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->sts_karir}}</td>
        </tr>
         <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Status Karir</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->perusahaan}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Penghasilan</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->penghasilan ?? '-'}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">Universitas</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->universitas ?? '-'}}</td>
        </tr>
        <tr>
            <th style="width: 30%; border: 1px solid #ddd;">No HP/ WA</th>
            <th style="width: 30%; border: 1px solid #ddd;">:</th>
            <td style="border: 1px solid #ddd;">{{$user->user_profile->telp ?? '-'}}</td>
        </tr>
    </table>
</body>
</html>

