@extends('layouts.app_guest')

@section('title', 'Beranda')

@push('css')
    <link rel="stylesheet" href="{{asset('')}}modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('')}}modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
@endpush

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (!isset(Auth::user()->user_profile) && Auth::check())
        <div class="card card-primary">
            <div class="card-header">
                <h4>Lengkapi Biodata Saudara {{auth()->user()->name}}</h4>
            </div>
            <div class="card-body">
                <form action="{{route('user.profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row tab">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" disabled value="{{auth()->user()->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">NISN</label>
                                <input type="text" disabled value="{{auth()->user()->nisn}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedbac">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name="tmp_lahir" value="{{old('tmp_lahir')}}" class="form-control @error('tmp_lahir') is-invalid @enderror">
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
                                <input type="date" name="tgl_lahir" value="{{old('tgl_lahir')}}" class="form-control @error('tgl_lahir') is-invalid @enderror">
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
                                    <option value="">- Pilih -</option>
                                    @for ($tahun = date('Y') - 10; $tahun <= date('Y'); $tahun++)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
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
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Kuliah">Kuliah</option>
                                    <option value="Belum">Belum Bekerja</option>
                                </select>
                                @error('sts_karir')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- hide --}}
                        <div class="col-lg-12 col-md-12" id="perusahaan_hide">
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <input type="text" name="perusahaan" id="perusahaan" class="form-control">
                                <span class="invalid-feedback-perusahaan text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" id="penghasilan_hide">
                            <div class="form-group">
                                <label for="">Penghasilan</label>
                                <select id="penghasilan" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="1.000.000.00 - 2.000.000.00">1.000.000.00 - 2.000.000.00</option>
                                    <option value="2.000.000.00 - 3.000.000.00">2.000.000.00 - 3.000.000.00</option>
                                    <option value="3.000.000.00 - 4.000.000.00">3.000.000.00 - 4.000.000.00</option>
                                    <option value="4.000.000.00 - 5.000.000.00">4.000.000.00 - 5.000.000.00</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <span class="invalid-feedback-penghasilan text-danger"></span>
                            </div>

                            <div class="form-group" id="append_penghasilan" >
                                <label for="">Isi Penghasilan Saudara</label>
                                <input type="text" name="penghasilan" id="append_penghasilan_2" class="form-control">
                                <span class="invalid-feedback-penghasilan-append text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" id="universitas_hide">
                            <div class="form-group">
                                <label for="">Universitas</label>
                                <input type="text" value="{{old('universitas')}}" class="form-control" name="universitas" id="universitas">
                                <span class="invalid-feedback-universitas text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">No Telephone</label>
                                <input type="number" value="{{old('telp')}}" name="telp" class="form-control @error('telp') is-invalid @enderror">
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
                                <input type="text" value="{{old('alamat')}}" name="alamat" class="form-control @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="">Foto 2 x 3 Atau 4 x 6</label>
                                <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="btn-send">
                        <button class="btn btn-primary float-right" id="store">Lengkapi Data</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif(!isset(Auth::user()->email_verified_at) && Auth::check())
     <div class="alert alert-warning">
        <b>Silahkan Lakukan Verifikasi Email Yang Sudah Di Kirim Ke Email {{Auth::user()->email}}</b>
     </div>
    @else
        <div class="card card-primary">
            <div class="card-body">
                <form >
                    <div class="form-group">
                        <label for="gradYear">Tahun Lulus:</label>
                        <select name="year" id="year" class="form-control">
                            @for ($tahun = date('Y') - 10; $tahun <= date('Y'); $tahun++)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-body">
                <div class="chart-container" style="position: relative; width:100%">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>

        <div class="section-title">Loker Terbaru</div>
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
    @endif
@endsection

@push('js')
    <script src="{{asset('')}}modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="{{asset('')}}js/page/components-user.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('chart');
            var chart;

            var currentYear = new Date().getFullYear();
            $('#year').val(currentYear);
            fetchData(currentYear);

            $('#year').change(function(e) {
                let year = $(this).val();
                fetchData(year);
            });

            function fetchData(year) {
                $.ajax({
                    url: '/api/get-chart?year=' + year,
                    method: 'GET',
                    success: function(data) {
                        if (chart) {
                            chart.destroy();
                        }

                        var labels = data.labels;
                        var values = data.values;

                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: [labels],
                                    data: values,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }

                })
            }

            $("#store").hide()
            $("#penghasilan_hide").hide();
            $("#universitas_hide").hide();
            $("#perusahaan_hide").hide();
            $("#sts_karir").change(function() {
                let value = $(this).val();
                if (value == 'Bekerja') {
                    $("#universitas_hide").hide();
                    $("#penghasilan_hide").show();
                    $("#perusahaan_hide").show();
                } else if(value == 'Kuliah') {
                    $("#penghasilan_hide").hide();
                    $("#universitas_hide").show();
                    $("#perusahaan_hide").hide();
                } else if(value == 'Belum') {
                    $("#penghasilan_hide").hide();
                    $("#universitas_hide").hide();
                    $("#perusahaan_hide").hide();
                    $("#store").show();
                } else {
                    $("#store").hide()
                }
            });

            $("#append_penghasilan").hide();
            $("#penghasilan").change(function() {
                let value = $(this).find('option:selected').val();
                $("#append_penghasilan_2").val(value);
                console.log(value);
                if (value == '') {
                    $("#penghasilan").addClass('is-invalid');
                    $(".invalid-feedback-penghasilan").html('Penghasilan Tidak Boleh kKsong.');
                    $("#store").hide();
                } else {
                    if (value != 'lainnya') {
                        $("#append_penghasilan").hide();
                    } else {
                        $("#append_penghasilan").show();
                    }
                    $("#store").show();
                }
            });

            $("#universitas").keyup(function() {
                let value = $(this).val();
                if (value == '') {
                    $("#universitas").addClass('is-invalid');
                    $(".invalid-feedback-universitas").html('Penghasilan Tidak Boleh kKsong.');
                    $("#store").hide();
                } else {
                    $("#store").show();
                }
            });
        });
    </script>
@endpush
