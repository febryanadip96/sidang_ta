@extends('layouts.app')

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
						<h3 class="box-title">Pendaftaran Sidang Tugas Akhir Periode {{$periodeAktif->nama}}</h3><br>
						<b>Batas Pendaftaran : {{$periodeAktif->batas_pendaftaran}}</b>
					</div>
				</div>
				<form class="form-horizontal" method="POST" action="{{ url('daftar') }}">
					<div class="box-body">
			          	{{ csrf_field() }}
			            <div class="form-group">
							<label for="nama" class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required autofocus>
							</div>
			            </div>
			            <div class="form-group">
							<label for="nrp" class="col-md-4 control-label">NRP</label>
							<div class="col-md-6">
								<input id="nrp" type="text" class="form-control" name="nrp" required>
							</div>
			            </div>

						<div class="form-group">
							<label for="no_telp" class="col-md-4 control-label">No. Telp</label>
							<div class="col-md-6">
								<div class="input-group">
				                  <input id="no_telp" type="text" class="form-control" name="no_telp" required data-inputmask='"mask": "9999-9999-9999"' data-mask>
				                  <div class="input-group-addon">
				                    <i class="fa fa-phone"></i>
				                  </div>
				                </div>
							</div>
			            </div>

						<div class="form-group">
							<label for="judul" class="col-md-4 control-label">Judul TA</label>
							<div class="col-md-6">
								<input id="judul" type="text" class="form-control" name="judul" required>
							</div>
			            </div>

						<div class="form-group">
							<label for="pembimbing_1_id" class="col-md-4 control-label">Pembimbing 1</label>
							<div class="col-md-6">
								<select id="pembimbing_1_id" name="pembimbing_1_id" class="form-control select2"  style="width: 100%;">
									@foreach($dosens as $dosen)
										<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->user->npk}})</option>
									@endforeach
				                </select>
							</div>
			            </div>

						<div class="form-group">
							<label for="pembimbing_2_id" class="col-md-4 control-label">Pembimbing 2</label>
							<div class="col-md-6">
								<select id="pembimbing_2_id" name="pembimbing_2_id" class="form-control select2">
									@foreach($dosens as $dosen)
										<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->user->npk}})</option>
									@endforeach
				                </select>
							</div>
			            </div>

						<div class="form-group">
							<label for="memo" class="col-md-4 control-label">Memo</label>
							<div class="col-md-6">
								<textarea id="memo" class="form-control" name="memo" cols="3"></textarea>
							</div>
			            </div>
			            <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-danger col-md-12">
									Daftar
								</button>
							</div>
			            </div>
					</div>
					<!-- /.box-body -->
				</form>
			</div>
			<!-- /.box -->
	  	</div>
  	</div>
</section>
<!-- /.content -->
@endsection
