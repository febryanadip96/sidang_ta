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
                        <button type="button" class="btn btn-md btn-danger pull-right"  data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah</button>
                        <h4>Master Dosen</h4>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPK</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Kelayakan</th>
                                <th class="no-sort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosens as $index=>$dosen)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$dosen->user->npk}}</td>
                                    <td>{{$dosen->user->name}}</td>
                                    <td>@if($dosen->user->role==3) Kalab @elseif($dosen->user->role==4) Dosen @endif</td>
                                    <td>@if($dosen->kelayakan) Layak @else Belum Layak @endif</td>
                                    <td><a class="btn btn-warning btn-xs btn-edit" data-url="{{url('paj/masterdosen/'.$dosen->id)}}">Edit</a> <a class="btn btn-danger btn-xs btn-delete" data-url="{{url('paj/masterdosen/'.$dosen->id)}}">Hapus</a></td>
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
                    <h4 class="modal-title">Tambah Dosen</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ url('paj/masterdosen') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npk" class="col-md-4 control-label">NPK</label>
                            <div class="col-md-6">
                                <input id="npk" type="text" class="form-control" name="npk" value="{{ old('npk') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="role" value="4" checked>Dosen</label>
                                <label class="radio-inline"><input type="radio" name="role" value="3">Kalab</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Kelayakan</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="kelayakan" value="1" checked>Ya</label>
                                <label class="radio-inline"><input type="radio" name="kelayakan" value="0">Tidak</label>
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
                    <h4 class="modal-title">Edit Dosen</h4>
                </div>
                <form id="formEdit" class="form-horizontal" method="POST" action="">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="usernameEdit" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="usernameEdit" type="text" class="form-control" name="username" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordEdit" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="passwordEdit" type="text" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npkEdit" class="col-md-4 control-label">NPK</label>
                            <div class="col-md-6">
                                <input id="npkEdit" type="text" class="form-control" name="npk" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nameEdit" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nameEdit" type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roleEdit" class="col-md-4 control-label">Role</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" id="roleEdit_4" name="role" value="4" checked>Dosen</label>
                                <label class="radio-inline"><input type="radio" id="roleEdit_3" name="role" value="3">Kalab</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelayakanEdit" class="col-md-4 control-label">Kelayakan</label>
                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" id="kelayakanEdit_1" name="kelayakan" value="1" checked>Ya</label>
                                <label class="radio-inline"><input type="radio" id="kelayakanEdit_0"  name="kelayakan" value="0">Tidak</label>
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
                    <h4 class="modal-title">Hapus Dosen</h4>
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
                $('#usernameEdit').val(data.user.username);
                $('#npkEdit').val(data.user.npk);
                $('#nameEdit').val(data.user.name);
                if(data.user.role == 4){
                    $('#roleEdit_4').prop('checked', true);
                }
                else{
                    $('#roleEdit_3').prop('checked', true);
                }
                if(data.kelayakan){
                    $('#kelayakanEdit_1').prop('checked', true);
                }
                else{
                    $('#kelayakanEdit_0').prop('checked', true);
                }
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
        $('.btn-delete').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                $('#formDelete').attr('action', url);
                $('#isiModalDelete').html("Anda yakin ingin menghapus data dosen "+data.user.name+" ("+data.user.npk+")?");
                $('#modal-delete').modal('show',{backdrop: 'true'});
            });
        });
    });
</script>
@endsection
