@extends('layouts.app_guest')

@section('title')
    {{Auth::user()->name}}
@endsection

@push('css')
@endpush

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Biodata {{auth()->user()->name}}</h4>
        <div class="card-header-action">
            <a href="{{route('user.profile.pdf', ['id' => Auth::user()->id, 'name' => Auth::user()->name])}}" class="btn btn-danger"><i class="fas fa-download"></i> Download CV</a>
        </div>
    </div>
    <div class="card-body">
        <form action="#" method="POST">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" disabled value="{{auth()->user()->name}}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" disabled value="{{auth()->user()->email}}" class="form-control">
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
                        <input type="text" disabled value="{{Auth::user()->user_profile->tmp_lahir ?? ''}}" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" disabled value="{{Auth::user()->user_profile->tgl_lahir ?? ''}}" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <select name="jurusans_id" disabled id="jurusans_id" class="form-control @error('jurusans_id') is-invalid @enderror">
                            <option value="">{{Auth::user()->user_profile->jurusan->name ?? ''}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="">Tahun Lulus</label>
                        <select name="thn_lulus" disabled id="thn_lulus" class="form-control @error('thn_lulus') is-invalid @enderror">
                            <option value="">{{Auth::user()->user_profile->thn_lulus ?? ''}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="">Status Karir</label>
                        <select name="sts_karir" disabled id="sts_karir" class="form-control @error('sts_karir') is-invalid @enderror">
                            <option value="{{Auth::user()->user_profile->sts_karir ?? ''}}">{{Auth::user()->user_profile->sts_karir ?? ''}}</option>
                        </select>
                    </div>
                </div>
                @if (Auth::user()->user_profile->sts_karir == 'Bekerja' )
                    <div class="col-lg-12 col-md-12" id="penghasilan_hide">
                        <div class="form-group">
                            <label for="">Penghasilan</label>
                            <input type="text" disabled value="{{Auth::user()->user_profile->penghasilan}}" class="form-control" name="penghasilan" id="penghasilan">
                            <span class="invalid-feedback-penghasilan text-danger"></span>
                        </div>
                    </div>
                @elseif(Auth::user()->user_profile->sts_karir == 'Kuliah')
                    <div class="col-lg-12 col-md-12" id="universitas_hide">
                        <div class="form-group">
                            <label for="">Universitas</label>
                            <input type="text" disabled value="{{Auth::user()->user_profile->universitas}}" class="form-control" name="universitas" id="universitas">
                            <span class="invalid-feedback-universitas text-danger"></span>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="number" name="telp" disabled value="{{Auth::user()->user_profile->telp ?? ''}}" class="form-control @error('telp') is-invalid @enderror">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
