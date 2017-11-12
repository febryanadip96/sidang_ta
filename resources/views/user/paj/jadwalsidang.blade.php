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
                        <h4>Jadwal Sidang TA {{$periodeAktif->nama}}</h4>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Pembimbing 1</th>
                                <th>Pembimbing 2</th>
                                <th>Tempat/Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{$mahasiswa->nrp}}</td>
                                <td>{{$mahasiswa->nama}}</td>
                                <td>{{$mahasiswa->pembimbing1->user->name}} ({{$mahasiswa->pembimbing1->user->npk}})</td>
                                <td>{{$mahasiswa->pembimbing2->user->name}} ({{$mahasiswa->pembimbing2->user->npk}})</td>
                                <td>
                                    <select data-url="{{url('paj/jadwalsidang')}}" 
                                    data-id={{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->id}} class="form-control" pembimbing1-id="{{$mahasiswa->pembimbing1->id}}" pembimbing2-id="{{$mahasiswa->pembimbing2->id}}">
                                        @if($mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal==null)
                                            <option value="0" selected>-</option>
                                            <option></option>
                                        @else
                                            <option></option>
                                            <option value="{{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->id}}" selected>
                                                {{Carbon\Carbon::parse($mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->tanggal)->formatLocalized('%A, %d %B %Y')}} 
                                                {{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->jadwal->waktu}} 
                                                {{$mahasiswa->jadwalSidang->where('periode_id', $periodeAktif->id)->first()->tempatJadwal->tempat->nama}}
                                            </option>
                                        @endif
                                    </select>
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
        $('select').on('click change', function(){
            var ini = $(this);
            var pilih = $(this).val();
            var url = $(this).attr('data-url');
            var idPembimbing1 = $(this).attr('pembimbing1-id');
            var idPembimbing2 = $(this).attr('pembimbing2-id');
            var days=['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
            var bulan=['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
            var hasil = "<option value='0'>-</option>";
            $.post(url,{idPembimbing1:idPembimbing1, idPembimbing2:idPembimbing2, pilih:pilih}, function(data){
                for (var i = 0; i < data.length; i++) {
                    var text="";
                    var from = data[i].jadwal.tanggal.split("-");
                    var d=new Date(from[0], from[1]-1, from[2]);
                    text +=days[d.getDay()];
                    var tanggal=d.getDate();
                    text +=', '+tanggal;
                    text +=' '+bulan[d.getMonth()];
                    var tahun=d.getFullYear();
                    text +=' '+tahun;
                    if(data[i].id == pilih){
                        hasil += '<option value="'+data[i].id+'" selected>'+text+' '+data[i].jadwal.waktu+' '+data[i].tempat.nama+'</option>';
                    }
                    else{
                        hasil += '<option value="'+data[i].id+'">'+text+' '+data[i].jadwal.waktu+' '+data[i].tempat.nama+'</option>';
                    }
                    
                    
                }
                ini.html(hasil);
            });
        });

        var pilihanSebelum;
        var pilihanSesudah;
        $('select').on('click', function(){
            pilihanSebelum = $(this).val();
        });

        $('select').on('change', function(){
            var ini = $(this);
            pilihanSesudah = $(this).val();
            var url = $(this).attr('data-url')+"/"+$(this).attr('data-id');
            $.ajax({
                url:url,
                type:'PUT',
                data:{
                    pilihanSebelum:pilihanSebelum,
                    pilihanSesudah:pilihanSesudah,
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
