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
                        <h4>Master Periode</h4>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
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
                                    <td><a class="btn btn-warning btn-xs" href="">Edit</a> <a class="btn btn-danger btn-xs" href="">Hapus</a></td>
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
    
</section>
<!-- /.content -->
@endsection
