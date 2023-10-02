@extends('layouts.app_guest')

@section('title')
    {{Auth::user()->name}}
@endsection

@push('css')
@endpush

@section('content')
@if (session()->has('message'))
    <div class="alert alert-info">
        {{session()->get('message')}}
    </div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h4>Biodata {{auth()->user()->name}}</h4>
        <div class="card-header-action">
            <a href="{{route('user.profile.pdf', ['id' => Auth::user()->id, 'name' => Auth::user()->name])}}" class="btn btn-danger"><i class="fas fa-download"></i> Download CV</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control @error('name') is-invalid @enderror">
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
                        <input type="text" name="email" value="{{auth()->user()->email}}" class="form-control @error('email') is-invalid @enderror">
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
                        <input type="text" disabled value="{{auth()->user()->nisn}}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Tempat Lahir</label>
                        <input type="text" value="{{Auth::user()->user_profile->tmp_lahir ?? ''}}" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror">
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
                        <input type="date" value="{{Auth::user()->user_profile->tgl_lahir ?? ''}}" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror">
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
                        <select name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror">
                            <option value="">- Pilih -</option>
                            <option value="TKJ" @if (Auth::user()->jurusan == 'TKJ') selected @endif>TKJ</option>
                            <option value="TKRO" @if (Auth::user()->jurusan == 'TKRO') selected @endif>TKRO</option>
                            <option value="Asper" @if (Auth::user()->jurusan == 'Asper') selected @endif>Asper</option>
                            <option value="MM" @if (Auth::user()->jurusan == 'MM') selected @endif>MM</option>
                        </select>
                        @error('jurusan')
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
                            @for ($tahun = date('Y') - 10; $tahun <= date('Y'); $tahun++)
                                <option value="{{ $tahun }}" @if (Auth::user()->user_profile->thn_lulus == $tahun) selected @endif>{{ $tahun }}</option>
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
                            <option value="Bekerja" @if (Auth::user()->user_profile->sts_karir == 'Bekerja') selected @endif>Bekerja</option>
                            <option value="Kuliah" @if (Auth::user()->user_profile->sts_karir == 'Kuliah') selected @endif>Kuliah</option>
                            <option value="Belum" @if (Auth::user()->user_profile->sts_karir == 'Belum') selected @endif>Belum Bekerja</option>
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
                        <input type="text" value="{{Auth::user()->user_profile->penghasilan}}" class="form-control @error('penghasilan') is-invalid @enderror" name="penghasilan" id="penghasilan">
                        <span class="invalid-feedback-penghasilan text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="perusahaan_hide">
                    <div class="form-group">
                        <label for="">Perusahaan</label>
                        <input type="text" name="perusahaan" value="{{Auth::user()->user_profile->perusahaan}}" id="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror">
                        <span class="invalid-feedback-perusahaan text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12" id="universitas_hide">
                    <div class="form-group">
                        <label for="">Universitas</label>
                        <input type="text" value="{{Auth::user()->user_profile->universitas}}" class="form-control @error('univaersitas') is-invalid @enderror" name="universitas" id="universitas">
                        <span class="invalid-feedback-universitas text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="number" name="telp" value="{{Auth::user()->user_profile->telp ?? ''}}" class="form-control @error('telp') is-invalid @enderror">
                        @error('telp')
                            <span class="invalid-feedback">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" value="{{Auth::user()->user_profile->alamat ?? ''}}" class="form-control @error('alamat') is-invalid @enderror">
                        @error('alamat')
                            <span class="invalid-feedback">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <img src="{{asset('img/avatar/alumni/' . Auth::user()->user_profile->avatar)}}" width="150" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-right">Update</button>
        </form>
    </div>
</div>
@endsection
