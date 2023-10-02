@extends('partials.app')

@section('title', 'Data Alumni')

@push('css')
    <link rel="stylesheet" href="{{ asset('') }}modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('') }}modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Alumni</h1>
    </div>

    <div class="section-body">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <button class="btn btn-danger" id="export"><i class="fas fa-file-pdf"></i></button>
                <button class="btn btn-primary ml-2" id="import"><i class="fas fa-file-import"></i></button>
                <a href="{{route('export.excel.alumni')}}" class="btn btn-success ml-2" id="import"><i class="fas fa-file-excel"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-md text-center display nowrap" id="table">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">No</th>
                                <th class="text-white">NISN</th>
                                <th class="text-white">Nama Lengkap</th>
                                <th class="text-white">Email</th>
                                <th class="text-white">Tempat & Tanggal Lahir</th>
                                <th class="text-white">Tahun Lulus</th>
                                <th class="text-white">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="javascript:void(0)" class="show" data-id="{{$item->id}}">{{$item->nisn}}</a></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email ?? ''}}</td>
                                    <td>{{$item->user_profile->tmp_lahir ?? 'belum mengisi'}}, {{$item->user_profile->tgl_lahir ?? 'belum mengisi'}}</td>
                                    <td>Angkatan {{$item->user_profile->thn_lulus ?? 'belum mengisi'}}</td>
                                    <td>
                                        @if (!isset($item->user_profile->avatar))
                                            <a href="{{url('/data-alumni/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal_{{$item->id}}"><i class="fas fa-trash"></i></a>
                                        @else
                                            <a href="{{url('/data-alumni/generate/' . $item->id)}}" target="__blank" class="btn btn-info btn-sm"><i class="fas fa-download"></i></a>
                                            <a href="{{url('/data-alumni/' . $item->id . '/edit')}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal_{{$item->id}}"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('modal')
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUserLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" class="form-check">
              <div class="row">
                <div class="col-lg-12">
                    <div id="msg">

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" id="name" disabled class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" id="email" disabled class="form-control">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">NISN</label>
                        <input type="text" id="nisn" disabled class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Tempat Lahir</label>
                        <input type="text" disabled id="tmp_lahir" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" disabled id="tgl_lahir" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Tahun Lulus</label>
                        <input type="text" name="" id="thn_lulus" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Status Karir</label>
                        <input type="text" name="" id="sts_karir" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-12" id="penghasilan_show">
                    <div class="form-group">
                        <label for="">Penghasilan</label>
                        <input type="text" id="penghasilan" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-12" id="universitas_show">
                    <div class="form-group">
                        <label for="">Universitas</label>
                        <input type="text" id="universitas" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">No Telephone</label>
                        <input type="number" id="telp" disabled class="form-control">
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="modalExportLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExportLabel">Export Data Alumni Per Angkatan Ke PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="GET" class="form-check">
            <div class="form-group">
                <label for="">Pilih Tahun Lulus</label>
                <select name="thn_lulus" id="thn_lulus_export" class="form-control">
                    <option value="">- Pilih -</option>
                    @for ($tahun = date('Y') - 10; $tahun <= date('Y'); $tahun++)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endfor
                </select>
            </div>
            <button type="button" class="btn btn-primary float-right" id="download">Unduh</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalImportLabel">Import Data Alumni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="{{route('import.alumni')}}" method="POST" class="form-check" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">File <span class="text-info">(xlsx, csv, xls)</span></label>
                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <a href="{{asset('template/contoh_format_excel.xlsx')}}" download="" class="btn btn-success float-left">Download Template Excel</a>
                <button type="submit" class="btn btn-primary float-right">Import</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Peringatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-danger"><b>Data Yang Di Hapus Tidak Bisa Di Kembalikan</b></p>
        </div>
        <div class="modal-footer">
            <form action="{{route('delete.alumni', $item->id)}}" method="POST">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger">Hapus</button>
            </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush

@push('js')
    <script src="{{ asset('') }}modules/datatables/datatables.min.js"></script>
    <script src="{{ asset('') }}modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('')}}modules/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table').DataTable();

            $('#export').click(function() {
                $("#modalExport").modal('show')
            })

            $('.show').click(function() {
                $(".form-check")[0].reset()
                let id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: '/data-alumni/' + id,
                        method: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            $('#modalUser').modal('show');
                            $('#modalUserLabel').html(res.data.name);

                            if (res.data.user_profile != null) {
                                $('#msg').html('<div class="alert alert-success"><b>Akun tervalidasi</b></div>')
                            } else {
                                $('#msg').html('<div class="alert alert-danger"><b>Akun belum tervalidasi</b></div>')
                            }

                            $("#name").val(res.data.name);
                            $("#email").val(res.data.email);
                            $("#nisn").val(res.data.nisn);
                            if (res.data.user_profile != null) {
                                $("#tmp_lahir").val(res.data.user_profile.tmp_lahir);
                                $("#tgl_lahir").val(res.data.user_profile.tgl_lahir);
                                $("#jurusan").val(res.data.jurusan);
                                $("#thn_lulus").val(res.data.user_profile.thn_lulus);
                                $("#sts_karir").val(res.data.user_profile.sts_karir);
                                $("#telp").val(res.data.user_profile.telp);

                                if (res.data.user_profile.sts_karir == 'Bekerja') {
                                    $("#penghasilan").val(res.data.user_profile.penghasilan);
                                } else if(res.data.user_profile.sts_karir == 'Kuliah') {
                                    $("#universitas").val(res.data.user_profile.universitas);
                                } else {
                                    $("#penghasilan").val('');
                                    $("#universitas").val('');
                                }
                            }
                        }
                    })
                }
            });

            $(".delete").click(function(e) {
                let id = $(this).data('id');
                swal({
                    title: 'Peringatan !',
                    text: 'Saudara yakin ingin menghapus data ini? data yang di hapus tidak bisa di kembalikan.',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/data-alumni/' + id,
                            method: 'DELETE',
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                swal(res.success, {
                                    icon: 'success',
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 3000);
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                });
            });

            $("#download").click(function(e) {
                let thn_lulus = $('#thn_lulus_export').val();
                window.open('/data-alumni/export/' + thn_lulus)
            });

            $("#import").click(function() {
                $("#modalImport").modal('show');
            })
        })
    </script>
@endpush
