@extends('layouts.apppaj')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        @include('includes.common.status')
        @include('includes.common.errors')
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="text-center">
                        <button type="button" class="btn btn-md btn-danger pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <h4>Master Tempat</h4>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th class="no-sort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempats as $index=>$tempat)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$tempat->nama}}</td>
                                        <td><a class="btn btn-warning btn-xs btn-edit" data-url="{{url('paj/mastertempat/'.$tempat->id)}}">Edit</a> <a class="btn btn-danger btn-xs btn-delete" data-url="{{url('paj/mastertempat/'.$tempat->id)}}">Hapus</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    <h4 class="modal-title">Tambah Tempat</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ url('paj/mastertempat') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
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

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Tempat</h4>
                </div>
                <form id="formEdit" class="form-horizontal" method="POST" action="">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="namaEdit" type="text" class="form-control" name="nama" required>
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

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus Tempat</h4>
                </div>
                <form id="formDelete" class="form-horizontal" method="POST" action="">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p id="isiModalDelete"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
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
        $('.btn-edit').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                $('#formEdit').attr('action', url);
                $('#namaEdit').val(data.nama);
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
        $('.btn-delete').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                $('#formDelete').attr('action', url);
                $('#isiModalDelete').html("Anda yakin ingin menghapus data tempat "+data.nama+"?");
                $('#modal-delete').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
