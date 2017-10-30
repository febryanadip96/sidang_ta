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
                        <form class="form-inline" method="post" action="{{url('paj/mastermahasiswa')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="periode">Pilih Periode:</label>
                                <select id="periode" name="periode_id" class="form-control">
                                    @foreach($periodes as $periode)
                                        <option value="{{$periode->id}}" @if($periode->id ==$periodeAktif->id) selected @endif>{{$periode->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="carisiswa" type="submit" class="btn btn-danger">
                                Cari
                            </button>
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
                        <tbody>
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
                                        <td><a class="btn btn-warning btn-xs" href="">Edit</a> <a class="btn btn-danger btn-xs" href="">Hapus</a></td>
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
    
</section>
<!-- /.content -->
@endsection
