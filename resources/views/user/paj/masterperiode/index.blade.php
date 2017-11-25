@extends('layouts.apppaj')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        @include('includes.common.status')
        @include('includes.common.errors')
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="text-center">
                        <button type="button" class="btn btn-md btn-danger pull-right"  data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <h4>Master Periode</h4>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Periode</th>
                                <th>Batas Pendaftaran</th>
                                <th>Status</th>
                                <th class="no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periodes as $index=>$periode)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$periode->nama}}</td>
                                    <td>{{Carbon\Carbon::parse($periode->tanggal_awal)->format('l, d F Y')}} - {{Carbon\Carbon::parse($periode->tanggal_akhir)->format('l, d F Y')}}</td>
                                    <td>{{$periode->batas_pendaftaran}}</td>
                                    <td>@if($periode->status) Aktif @else Tidak Aktif @endif</td>
                                    <td><a class="btn btn-warning btn-xs btn-setting" href="{{url('paj/masterperiode/'.$periode->id)}}">Setting</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Periode</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ url('paj/masterperiode') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="periode" class="col-md-4 control-label">Periode:</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="periode" type="text" class="form-control" name="periode" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="batas_pendaftaran" class="col-md-4 control-label">Batas Daftar:</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="batas_pendaftaran" class="form-control" name="batas_pendaftaran" required>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->

<script>
    $(function(){
        $('#periode').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            "opens": "center"
        });
        $('#batas_pendaftaran').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
        $('#batas_pendaftaran').datepicker("setDate", new Date());
    });
</script>
@endsection
