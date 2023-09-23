@extends('partials.app')

@section('title')
    {{$data->name}}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{$data->name}}</h1>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{$data->name}}</h4>
            </div>
            <div class="card-body">
                <form action="{{url('/data-alumni/update/' . $data->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="users_id" value="{{$data->id}}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="name" value="{{$data->name}}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{$data->email}}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" name="nisn" value="{{$data->nisn}}" class="form-control @error('nisn') is-invalid @enderror">
                                @error('nisn')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" value="{{$data->user_profile->tmp_lahir ?? ''}}" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror">
                                @error('tmp_lahir')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" value="{{$data->user_profile->tgl_lahir ?? ''}}" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror">
                                @error('tgl_lahir')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Jurusan</label>
                                <select name="jurusans_id" id="jurusans_id" class="form-control @error('jurusans_id') is-invalid @enderror">
                                    <option value="">- Pilih -</option>
                                    @foreach ($jurusan as $item)
                                        <option value="{{$item->id}}" {{$data->user_profile->jurusans_id ?? '' == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('jurusans_id')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Tahun Lulus</label>
                                <select name="thn_lulus" id="thn_lulus" class="form-control @error('thn_lulus') is-invalid @enderror">
                                    <option value="">- Pilih -</option>
                                    @for ($tahun = date('Y') - 10; $tahun <= date('Y'); $tahun++)
                                        <option value="{{ $tahun }}" {{$data->user_profile->thn_lulus ?? '' == $tahun ? 'selected' : ''}}>{{ $tahun }}</option>
                                    @endfor
                                </select>
                                @error('thn_lulus')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Status Karir</label>
                                <select name="sts_karir" id="sts_karir" class="form-control @error('sts_karir') is-invalid @enderror">
                                    <option value="">- Pilih -</option>
                                    <option value="Bekerja" @if (optional($data->user_profile)->sts_karir == 'Bekerja') selected @endif>Bekerja</option>
                                    <option value="Kuliah"  @if (optional($data->user_profile)->sts_karir == 'Kuliah') selected @endif>Kuliah</option>
                                    <option value="Belum"   @if (optional($data->user_profile)->sts_karir == 'Belum') selected @endif>Belum Bekerja</option>
                                </select>
                                @error('sts_karir')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" id="penghasilan_hide">
                            <div class="form-group">
                                <label for="">Penghasilan</label>
                                <input type="text" value="{{$data->user_profile->penghasilan ?? ''}}" class="form-control" name="penghasilan" id="penghasilan">
                                <span class="invalid-feedback-penghasilan text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" id="universitas_hide">
                            <div class="form-group">
                                <label for="">Universitas</label>
                                <input type="text" value="{{$data->user_profile->universitas ?? ''}}" class="form-control" name="universitas" id="universitas">
                                <span class="invalid-feedback-universitas text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">No Telephone</label>
                                <input type="number" name="telp" value="{{$data->user_profile->telp ?? ''}}" class="form-control @error('telp') is-invalid @enderror">
                                @error('telp')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="btn-send">
                        <button class="btn btn-primary float-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
@endpush
