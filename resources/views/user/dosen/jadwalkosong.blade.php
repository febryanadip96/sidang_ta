@extends('layouts.appdosen')

@section('content')
<!-- Main content -->
<section class="content">
  	<div class="row">
		@include('includes.common.status')
	  	@include('includes.common.errors')
	  	<div class="col-xs-12">
	  		<div class="box box-danger">
				<div class="box-header">
					<div class="text-center">
						<h3 class="box-title">Jadwal Kosong Periode {{$periode->nama}}</h3><br>
						<small>Klik pada jadwal yang bisa menguji</small>
					</div>
					<div class="pull-left">
						<span>Keterangan: <span style="background:black;">&nbsp;&nbsp;&nbsp;</span> Kosong | <span style="background:green;">&nbsp;&nbsp;&nbsp;</span> Diambil | <span style="background:red;">&nbsp;&nbsp;&nbsp;</span> Disable</span>
					</div>
				</div>
				<form class="form-horizontal" method="POST" action="{{ url('dosen/jadwalkosong/'.Auth::user()->dosen->id) }}">
					<div class="box-body table-responsive">
			          	{{ csrf_field() }}
			          	<table class="table">
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
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <th>08.30-10.00</th>
	                            @foreach($tanggals as $tanggal)
	                                <td>
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <th>10.00-11.30</th>
	                            @foreach($tanggals as $tanggal)
	                                <td>
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <th>11.30-13.00</th>
	                            @foreach($tanggals as $tanggal)
	                                <td>
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <th>13.00-14.30</th>
	                            @foreach($tanggals as $tanggal)
	                                <td>
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                        <tr>
	                            <th>14.30-16.00</th>
	                            @foreach($tanggals as $tanggal)
	                                <td>
	                                    <input type="hidden" name="jadwal[{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id}}]" tutup="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
										diambil="{{(Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}"
										value="{{Auth::user()->dosen->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}">
	                                </td>
	                            @endforeach
	                        </tr>
	                    </table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<a id="hapus" class="btn btn-success pull-left"><span class="glyphicon glyphicon-erase"></span> Hapus</a>
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
			<!-- /.box -->
	  	</div>
  	</div>
</section>
<!-- /.content -->

<script>
    $(function(){
        $('input[type=hidden]').each(function(){
            var tutup = $(this).attr('tutup');
            var cek = $(this).val();
            var diambil = $(this).attr('diambil');
            if(tutup == 1){
                $(this).parent().css("background", "red");
            }
            else if(cek == 1){
                $(this).parent().css("background", "black");
				if(diambil == 1){
                    $(this).parent().css("background", "green");
                }
            }
            else{
                $(this).parent().css("background", "none");
            }
        });
        $('td').on('click', function(){
        	var tutup = $(this).find('input[type=hidden]').attr('tutup');
			var diambil = $(this).find('input[type=hidden]').attr('diambil');
            if(tutup != 1 && diambil !=1){
                var cek = $(this).find('input[type=hidden]').val();
	            if(cek == 0){
	                $(this).css("background", "black");
	                $(this).find('input[type=hidden]').val(1);
	            }
	            else{
	                $(this).css("background", "none");
	                $(this).find('input[type=hidden]').val(0);
	            }
            }
        });
        $('#hapus').on('click', function(){
        	$('td').each(function(){
        		var tutup = $(this).find('input[type=hidden]').attr('tutup');
				var diambil = $(this).find('input[type=hidden]').attr('diambil');
	        	if(tutup != 1 && diambil != 1){
		            $(this).css("background", "none");
		            $(this).find('input[type=hidden]').val(0);
		        }
        	});
        });
    });
</script>
@endsection
