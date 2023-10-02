@extends('partials.app')

@section('title', 'Pengaturan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengaturan</h1>
    </div>

    <div class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile Sekolah</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Profile</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Reset Password</a>
                    </div>
                </nav>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('settings.post')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="">Nama Sekolah</label>
                                <input type="text" name="nm_sekolah" id="nm_sekolah" class="form-control @error('nm_sekolah') is-invalid @enderror">
                                @error('nm_sekolah')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email Sekolah</label>
                                <input type="email" name="email_sekolah" id="email_sekolah" class="form-control @error('email_sekolah') is-invalid @enderror">
                                @error('email_sekolah')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">No Telephone Sekolah</label>
                                <input type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror">
                                @error('telp')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30" rows="10"></textarea>
                                @error('alamat')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary float-right">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('settings.update.profile')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" value="{{Auth::user()->name}}" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Email Aktif</label>
                                <input type="email" value="{{Auth::user()->email}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('settings.reset.password')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirmation Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary float-right">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        $.getJSON('/settings/getSekolah', function(data) {
            let result = data[0];
            console.log(result);
            $("#id").val(result.id);
            $("#nm_sekolah").val(result.nm_sekolah);
            $("#email_sekolah").val(result.email_sekolah);
            $("#telp").val(result.telp);
            $("#alamat").val(result.alamat);
        })
    </script>
@endpush
