<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Alumni Tahun Angkatan {{$tahun}}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 20px
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 95%;
            text-align: center;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Alumni SMKN Tanjung Sari Tahun  Angakatan {{$tahun}}</h2>
    <div class="table-container">
        <table class="table table-striped table-hover table-bordered table-md text-center display nowrap" id="table">
           <thead class="bg-primary">
               <tr>
                   <th class="text-white">No</th>
                   <th class="text-white">NISN</th>
                   <th class="text-white">Nama Lengkap</th>
                   <th class="text-white">Email</th>
                   <th class="text-white">Tempat & Tanggal Lahir</th>
                   <th>Jurusan</th>
                   <th class="text-white">Tahun Lulus</th>
                   <th>Status Karir</th>
                   <th>Penghasilan</th>
                   <th>Universitas</th>
                   <th>No HP</th>
               </tr>
           </thead>
           <tbody>
               @forelse ($user as $item)
                   <tr>
                       <td>{{$loop->iteration}}</td>
                       <td>{{$item->user->nisn}}</td>
                       <td>{{$item->user->name}}</td>
                       <td>{{$item->user->email}}</td>
                       <td>{{$item->tmp_lahir ?? 'belum mengisi'}}, {{\Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y') ?? 'belum mengisi'}}</td>
                       <td>{{$item->jurusan->name}}</td>
                       <td>Angkatan {{$item->thn_lulus ?? 'belum mengisi'}}</td>
                       <td>
                         @if ($item->sts_karir == 'Belum')
                             Belum Bekerja
                         @else
                             {{$item->sts_karir}}
                         @endif
                       </td>
                       <td>
                        @if ($item->penghasilan != null)
                            {{number_format($item->penghasilan)}}
                        @else
                            -
                        @endif
                       </td>
                       <td>
                        @if ($item->universitas != null)
                            {{$item->universitas}}
                        @else
                            -
                        @endif
                       </td>
                       <td>{{$item->telp}}</td>
                   </tr>
                @empty
                   <tr>
                        <td colspan="11">Tidak Ada Data Alumni Pada Tahun Angkatan {{$tahun}}</td>
                   </tr>
               @endforelse
           </tbody>
       </table>
    </div>
</body>
</html>
