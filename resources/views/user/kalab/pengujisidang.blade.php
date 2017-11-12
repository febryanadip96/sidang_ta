@extends('layouts.appdosen')

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
                                <td>{{Carbon\Carbon::parse($mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->tanggal)->formatLocalized('%A, %d %B %Y')}}</td>
                                <td>{{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->waktu}}</td>
                                <td>{{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->tempat->nama}}</td>
                                <td>{{$mahasiswa->pembimbing1->user->name}} ({{$mahasiswa->pembimbing1->user->npk}})</td>
                                <td>{{$mahasiswa->pembimbing2->user->name}} ({{$mahasiswa->pembimbing2->user->npk}})</td>
                                <td>
                                    <select class="form-control sekretaris" data-url="{{url('kalab/pengujisidang/sekretaris')}}" data-id="{{$mahasiswa->jadwalSidang->where('periode_id',$periodeAktif->id)->first()->id}}">
                                        @if($mahasiswa->sekretatis==null)
                                            <option value="0" selected>-</option>
                                            <option></option>
                                        @else
                                            <option></option>
                                            <option value="{{$mahasiswa->sekretatis->id}}" selected>
                                                {{$mahasiswa->sekretatis->user->name}} ({{$mahasiswa->sekretatis->user->npk}})
                                            </option>
                                        @endif
                                    </select><br>
                                    <span class="total-menguji"></span>
                                </td>
                                <td>
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
                                    </select><br>
                                    <span class="total-menguji"></span>
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
    </div>
    
</section>
<!-- /.content -->

<script>
    $(function(){
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
                    if(data){
                        ini.css('background', 'yellow');
                        ini.delay(5000).queue(function (next) { 
                            $(this).css('background', 'none'); 
                            next(); 
                        });
                    }
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
                    if(data){
                        ini.css('background', 'yellow');
                        ini.delay(5000).queue(function (next) { 
                            $(this).css('background', 'none'); 
                            next(); 
                        });
                    }
                },
            });
        });
    });
</script>
@endsection
