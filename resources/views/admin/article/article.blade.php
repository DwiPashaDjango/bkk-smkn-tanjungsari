@extends('partials.app')

@section('title', 'Data Lowongan Kerja')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Lowongan Kerja</h1>
    </div>

    <div class="section-body">
        @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('admin.lokers.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            <form action="{{route('admin.lokers')}}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari Lowongan Kerja...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="clearfix mb-3"></div>

                        <div class="table-responsive">
                            <table class="table table-striped table-md table-bordered text-center">
                                <tr class="bg-primary text-white">
                                    <th>Foto Perusahaan</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Lokasi</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                                @forelse ($lokers as $item)
                                    <tr>
                                        <td>
                                        <img src="{{asset('img/article/' . $item->thumbnail)}}" width="80" class="img-thumbnail" alt="">
                                        </td>
                                        <td>
                                            {{$item->nm_pt}}
                                            <div class="table-links">
                                                <a class="btn btn-default" href="{{route('admin.loker.edit', ['id' => $item->id, 'nm_pt' => $item->nm_pt])}}" data-id="{{$item->id}}">Edit</a>
                                                <div class="bullet"></div>
                                                <form action="{{url('/data-lokers/' . $item->id)}}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="btn btn-default text-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#">{{$item->lokasi}}</a>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <div class="d-inline-block ml-1">{{$item->author->name}}</div>
                                            </a>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d F Y')}}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <div class="badge badge-primary">Published</div>
                                            @else
                                                <div class="badge badge-warning">Draft</div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Tidak Ada Data Lowongan Kerja</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                        <div class="float-right">
                            {{$lokers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
