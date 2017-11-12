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
                        <h4>Master Mahasiswa</h4>
                    </div>
                </div>
                <div class="box-body">
                    <div class="text-center">
                        <form id="formcarisiswa" class="form-inline" method="post" action="{{url('paj/mastermahasiswa')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="periode">Pilih Periode:</label>
                                <select id="periode" name="periode_id" class="form-control">
                                    @foreach($periodes as $periode)
                                        <option value="{{$periode->id}}" @if($periode->id ==$periodeAktif->id) selected @endif>{{$periode->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div><br>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle">No</th>
                                <th rowspan="2" style="vertical-align:middle">NRP</th>
                                <th rowspan="2" style="vertical-align:middle">Nama</th>
                                <th rowspan="2" style="vertical-align:middle">Judul TA</th>
                                <th rowspan="2" style="vertical-align:middle">No Telp</th>
                                <th rowspan="2" style="vertical-align:middle">Pembimbing 1</th>
                                <th rowspan="2" style="vertical-align:middle">Pembimbing 2</th>
                                <th colspan="6">Persyaratan</th>
                                <th rowspan="2" class="no-sort" style="vertical-align:middle">Aksi</th>
                            </tr>
                            <tr>
                                <th class="no-sort">1</th>
                                <th class="no-sort">2</th>
                                <th class="no-sort">3</th>
                                <th class="no-sort">4</th>
                                <th class="no-sort">5</th>
                                <th class="no-sort">6</th>
                            </tr>
                        </thead>
                        <tbody id="data-mahasiswa">
                            @if(isset($mahasiswas))
                                @foreach($mahasiswas as $index=>$mahasiswa)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$mahasiswa->nrp}}</td>
                                        <td>{{$mahasiswa->nama}}</td>
                                        <td>{{$mahasiswa->judul}}</td>
                                        <td>{{$mahasiswa->no_telp}}</td>
                                        <td>{{$mahasiswa->pembimbing1->user->name}}</td>
                                        <td>{{$mahasiswa->pembimbing2->user->name}}</td>
                                        <td>@if($mahasiswa->persyaratan_1)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td>@if($mahasiswa->persyaratan_2)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td>@if($mahasiswa->persyaratan_3)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td>@if($mahasiswa->persyaratan_4)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td>@if($mahasiswa->persyaratan_5)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td>@if($mahasiswa->persyaratan_6)<i class="fa fa-check-circle"></i>@else<i class="fa fa-circle-thin"></i>@endif</td>
                                        <td><a class="btn btn-warning btn-xs btn-edit" data-url="{{url('paj/mastermahasiswa/'.$mahasiswa->id)}}">Edit</a>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span id="namaEdit"></span> (<span id="nrpEdit"></span>)</h4>
                </div>
                <form id="formEdit" class="form-horizontal" method="POST" action="">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <a class="btn btn-danger btn-hapus-cek">Hapus Semua</a> <a class="btn btn-success btn-cek-semua">Cek Semua</a>

                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_1" name="persyaratan_1" value="1">Persyaratan 1</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_2" name="persyaratan_2" value="1">Persyaratan 2</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_3" name="persyaratan_3" value="1">Persyaratan 3</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_4" name="persyaratan_4" value="1">Persyaratan 4</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_5" name="persyaratan_5" value="1">Persyaratan 5</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="persyaratan_6" name="persyaratan_6" value="1">Persyaratan 6</label>
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
    $('#periode').on('change', function(){
        $('#formcarisiswa').submit();
    });
    $('.btn-edit').on('click', function(){
            var url = $(this).attr('data-url');
            $.get(url, function(data){
                //alert(JSON.stringify(data));
                $('#formEdit').attr('action', url);
                $('#nrpEdit').html(data.nrp);
                $('#namaEdit').html(data.nama);
                $('input[type=checkbox]').attr('checked', true);
                $('#modal-edit').modal('show',{backdrop: 'true'});
            });
        });
    $('.btn-cek-semua').on('click', function(){
        $('input[type=checkbox]').attr('checked', true);
    });
    $('.btn-hapus-cek').on('click', function(){
        $('input[type=checkbox]').attr('checked', false);
    });
</script>
@endsection
