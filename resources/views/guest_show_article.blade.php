@extends('layouts.app_guest')

@section('title')
{{$loker->nm_pt}}
@endsection

@push('css')
<style>
    .thumbnail {
        width: 100%
    }
</style>
<link rel="stylesheet" href="{{asset('')}}modules/owlcarousel2/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="{{asset('')}}modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <br>
        <h3 class="pb-2 text-center">Lowongan Pekerjaan {{ $loker->nm_pt }}</h3>
        <p class="text-center"><b>Kota : {{ $loker->lokasi }} | Penempatan Kantor : {{ $loker->kantor }}</b></p>
        <br>
        <img class="thumbnail rounded" src="{{asset('img/article/' . $loker->thumbnail)}}" alt="">
        <div class="card-text">
            <p>
                {!! $loker->description !!}
            </p>
        </div>
    </div>
</div>

<div class="section-title">Loker Lainnya</div>
<br>
<div class="owl-carousel owl-theme row" id="users-carousel">
    @foreach ($loker_all as $item)
        <div>
            <div class="col-lg-12">
                <article class="article">
                    <div class="article-header">
                        <img class="article-image" src="{{asset('img/article/' . $item->thumbnail)}}">
                        <div class="article-title">
                            <h2><a href="{{route('guest.article.show', ['id' => $item->id, 'nm_pt' => $item->nm_pt])}}">{{$item->nm_pt}}</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>
                            {!! Str::words($item->description, 50, '...') !!}
                        </p>
                        <div class="article-cta">
                            <a href="{{route('guest.article.show', ['id' => $item->id, 'nm_pt' => $item->nm_pt])}}" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('js')
<script src="{{asset('')}}modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="{{asset('')}}js/page/components-user.js"></script>
@endpush
