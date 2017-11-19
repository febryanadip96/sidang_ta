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
                        <h4>Jadwal Kosong Dosen Pembimbing dan Penguji {{$mahasiswa->nama}} ({{$mahasiswa->nrp}})</h4>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <h5 class="text-center"><b>Pembimbing 1: {{$mahasiswa->pembimbing1->user->name}}</b></h5>
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
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>08.30-10.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>10.00-11.30</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden" tutup="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>11.30-13.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}" kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>13.00-14.30</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>14.30-16.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing1->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12 table-responsive">
                            <h5 class="text-center"><b>Pembimbing 2: {{$mahasiswa->pembimbing2->user->name}}</b></h5>
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
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>08.30-10.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>10.00-11.30</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden" tutup="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>11.30-13.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}" kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>13.00-14.30</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>14.30-16.00</th>
                                    @foreach($tanggals as $tanggal)
                                        <td>
                                            <input type="hidden"
                                            tutup="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                            kosong="{{$mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                            diambil="{{($mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->pembimbing2->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        @if(isset($mahasiswa->sekretaris) && isset($mahasiswa->ketua))
                            <div class="col-xs-12 table-responsive">
                                <h5 class="text-center"><b>Sekretaris: {{$mahasiswa->sekretaris->user->name}}</b></h5>
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
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>08.30-10.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>10.00-11.30</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden" tutup="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>11.30-13.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}" kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>13.00-14.30</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>14.30-16.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->sekretaris->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-12 table-responsive">
                                <h5 class="text-center"><b>Ketua: {{$mahasiswa->ketua->user->name}}</b></h5>
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
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','07.00-08.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>08.30-10.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','08.30-10.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>10.00-11.30</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden" tutup="{{$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','10.00-11.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>11.30-13.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}" kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','11.30-13.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>13.00-14.30</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','13.00-14.30')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>14.30-16.00</th>
                                        @foreach($tanggals as $tanggal)
                                            <td>
                                                <input type="hidden"
                                                tutup="{{$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->disabled}}"
                                                kosong="{{$mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null?1:0}}"
                                                diambil="{{($mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()!==null && $mahasiswa->ketua->jadwalKosong->where('id',$jadwals->where('waktu','14.30-16.00')->where('tanggal',$tanggal->tanggal)->first()->id)->first()->pivot->diambil)?1:0}}">
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
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
        $('input[type=hidden]').each(function(){
            var tutup = $(this).attr('tutup');
            var kosong = $(this).attr('kosong');
            var diambil = $(this).attr('diambil');
            if(tutup == 1){
                $(this).parent().css("background", "red");
            }
            else if(kosong == 1){
                $(this).parent().css("background", "black");
                if(diambil == 1){
                    $(this).parent().css("background", "green");
                }
            }
            else{
                $(this).parent().css("background", "none");
            }
        });
    });
</script>
@endsection
