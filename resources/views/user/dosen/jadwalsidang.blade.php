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
                    <table class="table datatable">
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
                                <td>{{$mahasiswa->judul}}</td>
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
                                <td>
                                    @if($mahasiswa->sekretaris)
                                    {{$mahasiswa->sekretaris->user->name}} ({{$mahasiswa->sekretaris->user->npk}})
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($mahasiswa->ketua)
                                    {{$mahasiswa->ketua->user->name}} ({{$mahasiswa->ketua->user->npk}})
                                    @else
                                    -
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
    </div>
    
</section>
<!-- /.content -->
@endsection
