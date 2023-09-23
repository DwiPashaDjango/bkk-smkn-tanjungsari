@extends('partials.app')

@section('title', 'Buat Informasi Lowongan Kerja')

@push('css')
    <link rel="stylesheet" href="{{asset('')}}modules/summernote/summernote-bs4.css">
    <style>
        .image-preview {
            width: 100%
        }
    </style>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Buat Informasi Lowongan Kerja</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Buat Informasi Lowongan Kerja</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.lokers.post')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Perusahaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Pilih Gambar</label>
                                        <input type="file" name="thumbnail" class="@error('thumbnail') is-invalid @enderror" max="2048" id="image-upload" required />
                                    </div>
                                    @error('thumbnail')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Perusahaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('nm_pt') is-invalid @enderror" name="nm_pt">
                                    @error('nm_pt')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi / Kota <span class="text-info">(Tempat Kerja)</span></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi">
                                    @error('lokasi')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penempatan <span class="text-info">(Kantor Utama / Cabang)</span></label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('kantor') is-invalid @enderror" name="kantor">
                                    @error('kantor')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Tentang Pekerjaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple @error('description') is-invalid @enderror" name="description" required></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="">- Pilih -</option>
                                        <option value="1">Published</option>
                                        <option value="0">Draft</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary float-right">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    <script src="{{asset('')}}modules/summernote/summernote-bs4.js"></script>
    <script src="{{asset('')}}modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script>
        $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });
    </script>
@endpush
