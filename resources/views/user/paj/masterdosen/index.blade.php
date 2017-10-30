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
                        <h4>Master Dosen</h4>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
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
