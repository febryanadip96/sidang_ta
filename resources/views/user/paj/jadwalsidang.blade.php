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
                        <h4>Jadwal Sidang TA</h4>
                    </div>
                </div>
                <div class="box-body">
                    <p>Ini Jadwal Sidang</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>
<!-- /.content -->
@endsection
