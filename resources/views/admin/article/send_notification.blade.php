<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$article->nm_pt}}</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            max-width: 500px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Jumlah baris yang ingin ditampilkan */
            -webkit-box-orient: vertical;
        }

        .card .button-lihat {
            background-color: #6610e7;
            color: #fff;
            text-align: center;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            display: block;
            width: 95%;
        }

        .card .button-lihat:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>{{$article->nm_pt}}</h2>
        <p style="word-break: break-all">
            Dear Alumni SMKN Tanjung Sari Telah Di Buka Lowongan Pekerjaan Di {{$article->nm_pt}} Tolong Di Lihat Persyaratan Di Bawah Ini
        </p>
        <p style="word-break: break-all">
            {!! Str::words($article->description, 75, '...') !!}
        </p>
        <a href="{{route('guest.article.show', ['id' => $article->id, 'nm_pt' => $article->nm_pt])}}" class="button-lihat">Lihat Selengkapnya</a>
    </div>
</body>
</html>
