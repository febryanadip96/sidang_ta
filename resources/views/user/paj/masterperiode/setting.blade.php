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
                        <h4><b>Setting Periode {{$periode->nama}}</b></h4>
                        <h6>Beri arsiran untuk jadwal yang ingin ditutup</h6>
                    </div>
                </div>
                <form class="form-horizontal" method="POST" action="{{url('paj/masterperiode/'.$periode->id)}}">
                <div class="box-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <table class="table table-bordered">
                        <tr>
                            <th>Jam \ Tanggal</th>
                            @foreach($tanggals as $tanggal)
                                <th>{{Carbon\Carbon::parse($tanggal->tanggal)->formatLocalized('%A, %d %B %Y')}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>07.00-08.30</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>08.30-10.00</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>10.00-11.30</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>11.30-13.00</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>13.00-14.30</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>14.30-16.00</th>
                            @foreach($tanggals as $tanggal)
                                <td>
                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" value="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}">
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <div class="box-footer">
                        <a id="hapus" class="btn btn-success pull-left"><span class="glyphicon glyphicon-erase"></span> Hapus</a>
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
</section>
<!-- /.content -->

<script>
    $(function(){
        $('input[type=hidden]').each(function(){
            var cek = $(this).val();
            if(cek == 1){
                $(this).parent().css("background", "red");
            }
        });
        $('td').on('click', function(){
            var cek = $(this).find('input[type=hidden]').val();
            if(cek == 0){
                $(this).css("background", "red");
                $(this).find('input[type=hidden]').val(1);
            }
            else{
                $(this).css("background", "none");
                $(this).find('input[type=hidden]').val(0);
            }
            
        });
        $('#hapus').on('click', function(){
            $('td').css("background", "none");
            $('input[type=hidden').val(0);
        });
    });
</script>
@endsection
