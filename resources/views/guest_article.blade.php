@extends('layouts.app_guest')

@section('title')
    Layanan Informasi Lowongan Pekerjaan
@endsection

@push('css')
@endpush

@section('content')
<form action="{{route('guest.article')}}" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="search" placeholder="Cari Lowongan Pekerjaan..." aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
@if ($loker->count() > 0)
    <div class="row">
        @foreach ($loker as $item)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
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
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{$loker->links()}}
    </div>
@else
    <div class="alert alert-primary">
        <b>Tidak Ada Lowongan Pekerjaan</b>
    </div>
@endif
@endsection

@push('js')

@endpush
