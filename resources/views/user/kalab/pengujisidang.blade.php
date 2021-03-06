@extends('layouts.appdosen')

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
                        <h4>Jadwal Sidang TA {{$periodeAktif->nama}}</h4>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Pembimbing 1</th>
                                <th>Pembimbing 2</th>
                                <th>Sekretaris</th>
                                <th>Ketua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{$mahasiswa->nrp}}</td>
                                <td>{{$mahasiswa->nama}}</td>
                                <td title="{{$mahasiswa->judul}}">{{$mahasiswa->judul}}</td>
                                @if($mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal==null)
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                @else
                                    <td>{{Carbon\Carbon::parse($mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->tanggal)->formatLocalized('%A, %d %B %Y')}}</td>
                                    <td>{{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->waktu}}</td>
                                    <td>{{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->tempat->nama}}</td>
                                @endif
                                <td>{{$mahasiswa->pembimbing1->user->name}} ({{$mahasiswa->pembimbing1->user->npk}})</td>
                                <td>{{$mahasiswa->pembimbing2->user->name}} ({{$mahasiswa->pembimbing2->user->npk}})</td>
                                <td class="text-center">
                                    <select class="form-control sekretaris" data-url="{{url('kalab/pengujisidang/sekretaris')}}" data-id="{{$mahasiswa->jadwalSidang->where('periode_id',$periodeAktif->id)->first()->id}}">
                                        @if($mahasiswa->sekretaris==null)
                                            <option value="0" selected>-</option>
                                            <option></option>
                                        @else
                                            <option></option>
                                            <option value="{{$mahasiswa->sekretaris->id}}" selected>
                                                {{$mahasiswa->sekretaris->user->name}} ({{$mahasiswa->sekretaris->user->npk}})
                                            </option>
                                        @endif
                                    </select>
                                    @if($mahasiswa->sekretaris==null)
                                        <span class="menguji-0">0</span>
                                    @else
                                        <span class="menguji-{{$mahasiswa->sekretaris->id}}">{{$mahasiswa->sekretaris->sekretaris->count()+$mahasiswa->sekretaris->ketua->count()}}</span>
                                    @endif

                                </td>
                                <td class="text-center">
                                    <select class="form-control ketua"  data-url="{{url('kalab/pengujisidang/ketua')}}" data-id="{{$mahasiswa->jadwalSidang->where('periode_id',$periodeAktif->id)->first()->id}}">
                                        @if($mahasiswa->ketua==null)
                                            <option value="0" selected>-</option>
                                            <option></option>
                                        @else
                                            <option></option>
                                            <option value="{{$mahasiswa->ketua->id}}" selected>
                                                {{$mahasiswa->ketua->user->name}} ({{$mahasiswa->ketua->user->npk}})
                                            </option>
                                        @endif
                                    </select>
                                    @if($mahasiswa->ketua==null)
                                        <span class="menguji-0">0</span>
                                    @else
                                        <span class="menguji-{{$mahasiswa->ketua->id}}">{{$mahasiswa->ketua->sekretaris->count()+$mahasiswa->ketua->ketua->count()}}</span>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->
		<div class="col-xs-12">
			<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Jumlah Menguji</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="col-xs-6">
					<div class="col-xs-12"><b>Dosen Tidak Layak</b></div>
					@foreach($dosenTidakLayaks as $dosenTidakLayak)
						<div class="col-xs-6">
							{{$dosenTidakLayak->user->name}} : <span class="total-menguji menguji-{{$dosenTidakLayak->id}}">{{$dosenTidakLayak->sekretaris->count()+$dosenTidakLayak->ketua->count()}}</span>
						</div>
					@endforeach
				</div>
				<div class="col-xs-6">
					<div class="col-xs-12"><b>Dosen Layak</b></div>
					@foreach($dosenLayaks as $dosenLayak)
						<div class="col-xs-6">
							{{$dosenLayak->user->name}} : <span class="total-menguji menguji-{{$dosenLayak->id}}">{{$dosenLayak->sekretaris->count()+$dosenLayak->ketua->count()}}</span>
						</div>
					@endforeach
				</div>
			</div>
			<!-- /.box-body -->
		</div>
    </div>
</section>
<!-- /.content -->

<script>
    $(function(){
		cekJumlahMenguji();
        $('.sekretaris').on('click change', function(){
            var ini = $(this);
            var pilih = $(this).val();
            var url = $(this).attr('data-url')+"/"+$(this).attr('data-id');
            var hasil = "<option value='0'>-</option>";
            $.post(url,{pilih:pilih},function(data){
                //alert(JSON.stringify(data));
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == pilih){
                        hasil += '<option value="'+data[i].id+'" selected>'+data[i].user.name+'('+data[i].user.npk+')</option>';
                    }
                    else{
                        hasil += '<option value="'+data[i].id+'" >'+data[i].user.name+'('+data[i].user.npk+')</option>';
                    }
                }
                ini.html(hasil);
            });
        });

        var sekretarisSebelum;
        var sekretarisSesudah;
        $('.sekretaris').on('click', function(){
            sekretarisSebelum = $(this).val();
        });

        $('.sekretaris').on('change', function(){
            var ini = $(this);
            sekretarisSesudah = $(this).val();
            ini.parent().find('span').removeClass('menguji-'+sekretarisSebelum);
            ini.parent().find('span').addClass('menguji-'+sekretarisSesudah);
            var url = $(this).attr('data-url')+"/"+$(this).attr('data-id');
            $.ajax({
                url:url,
                type:'PUT',
                data:{
                    sekretarisSebelum:sekretarisSebelum,
                    sekretarisSesudah:sekretarisSesudah,
                },
                success: function(data){
                    //alert(JSON.stringify(data));
                    if(data.hasil){
                        ini.css('background', 'yellow');
                        for (var i in data.data) {
                            //alert(i+" "+data.data[i]);
                            $('.menguji-'+i).html(data.data[i])
                        }
                        ini.delay(5000).queue(function (next) {
                            $(this).css('background', 'none');
                            next();
                        });
                    }
					cekJumlahMenguji();
                },
            });
        });

        $('.ketua').on('click change', function(){
            var ini = $(this);
            var pilih = $(this).val();
            var url = $(this).attr('data-url')+"/"+$(this).attr('data-id');
            var hasil = "<option value='0'>-</option>";
            $.post(url,{pilih:pilih},function(data){
                //alert(JSON.stringify(data));
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == pilih){
                        hasil += '<option value="'+data[i].id+'" selected>'+data[i].user.name+'('+data[i].user.npk+')</option>';
                    }
                    else{
                        hasil += '<option value="'+data[i].id+'" >'+data[i].user.name+'('+data[i].user.npk+')</option>';
                    }
                }
                ini.html(hasil);
            });
        });

        var ketuaSebelum;
        var ketuaSesudah;
        $('.ketua').on('click', function(){
            ketuaSebelum = $(this).val();
        });

        $('.ketua').on('change', function(){
            var ini = $(this);
            ketuaSesudah = $(this).val();
            ini.parent().find('span').removeClass('menguji-'+ketuaSebelum);
            ini.parent().find('span').addClass('menguji-'+ketuaSesudah);
            var url = $(this).attr('data-url')+"/"+$(this).attr('data-id');
            $.ajax({
                url:url,
                type:'PUT',
                data:{
                    ketuaSebelum:ketuaSebelum,
                    ketuaSesudah:ketuaSesudah,
                },
                success: function(data){
                    //alert(JSON.stringify(data));
                    if(data.hasil){
                        ini.css('background', 'yellow');
                        for (var i in data.data) {
                            //alert(i+" "+data.data[i]);
                            $('.menguji-'+i).html(data.data[i])
                        }
                        ini.delay(5000).queue(function (next) {
                            $(this).css('background', 'none');
                            next();
                        });
                    }
					cekJumlahMenguji();
                },
            });
        });

		function cekJumlahMenguji(){
			$('.total-menguji').each(function(){
				if($(this).html()==0){
					$(this).css('background', 'red');
				}
				else{
					$(this).css('background', 'none');
				}
			});
		}
    });
</script>
@endsection
