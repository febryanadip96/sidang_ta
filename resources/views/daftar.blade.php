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
						<b>Batas Pendaftaran : {{Carbon\Carbon::parse($periodeAktif->batas_pendaftaran)->format('l, d F Y')}}</b>
					</div>
				</div>
				<form class="form-horizontal" method="POST" action="{{ url('daftar') }}">
					<div class="box-body">
			          	{{ csrf_field() }}
			          	<div class="form-group">
							<label for="nrp" class="col-md-4 control-label">NRP</label>
							<div class="col-md-6">
								<input id="nrp" type="text" class="form-control" name="nrp" value="{{ old('nrp') }}" required autofocus>
							</div>
			            </div>

			            <div class="form-group">
							<label for="nama" class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" disabled required>
							</div>
			            </div>

						<div class="form-group">
							<label for="no_telp" class="col-md-4 control-label">No. Telp</label>
							<div class="col-md-6">
								<div class="input-group">
				                  <input id="no_telp" type="text" class="form-control" name="no_telp" required data-inputmask='"mask": "9999-9999-9999"' data-mask value="{{ old('no_telp') }}" disabled>
				                  <div class="input-group-addon">
				                    <i class="fa fa-phone"></i>
				                  </div>
				                </div>
							</div>
			            </div>

						<div class="form-group">
							<label for="judul" class="col-md-4 control-label">Judul TA</label>
							<div class="col-md-6">
								<input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" required disabled>
							</div>
			            </div>

						<div class="form-group">
							<label for="pembimbing_1_id" class="col-md-4 control-label">Pembimbing 1</label>
							<div class="col-md-6">
								<select id="pembimbing_1_id" name="pembimbing_1_id" class="form-control"  style="width: 100%;" disabled>
									<option>-</option>
									@foreach($dosens as $dosen)
										<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->user->npk}})</option>
									@endforeach
				                </select>
							</div>
			            </div>

						<div class="form-group">
							<label for="pembimbing_2_id" class="col-md-4 control-label">Pembimbing 2</label>
							<div class="col-md-6">
								<select id="pembimbing_2_id" name="pembimbing_2_id" class="form-control" disabled>
									<option>-</option>
									@foreach($dosens as $dosen)
										<option value="{{$dosen->id}}">{{$dosen->user->name}} ({{$dosen->user->npk}})</option>
									@endforeach
				                </select>
							</div>
			            </div>

						<div class="form-group">
							<label for="memo" class="col-md-4 control-label">Memo</label>
							<div class="col-md-6">
								<textarea id="memo" class="form-control" name="memo" cols="3" value="{{ old('memo') }}" disabled></textarea>
							</div>
			            </div>
			            <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button id="btnSubmit" type="submit" class="btn btn-danger col-md-12" disabled>
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

<script>
	$(function(){
		$('#pembimbing_1_id').change(function() {
			var value = $(this).val();
		    $('#pembimbing_2_id').children('option').each(function() {
		        if ( $(this).val() === value ) {
		            $(this).attr('disabled', true).siblings().removeAttr('disabled');   
		        }
		    });
		});
		$('#pembimbing_2_id').change(function() {
			var value = $(this).val();
		    $('#pembimbing_1_id').children('option').each(function() {
		        if ( $(this).val() === value ) {
		            $(this).attr('disabled', true).siblings().removeAttr('disabled');   
		        }
		    });
		});
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$('#nrp').change(function(){
			var nrp = $(this).val();
			$.post("{{url('daftar/cekmahasiswa')}}",{nrp:nrp},function(data){
				//alert(JSON.stringify(data));
				if(data.terdaftar){
					$('#nama').val(data.mahasiswa.nama).attr('disabled',true);
					$('#no_telp').val(data.mahasiswa.no_telp).attr('disabled',true);
					$('#judul').val(data.mahasiswa.judul).attr('disabled',true);
					$('#pembimbing_1_id').val(data.mahasiswa.pembimbing_1_id).attr('disabled',true);
					$('#pembimbing_2_id').val(data.mahasiswa.pembimbing_2_id).attr('disabled',true);
					$('#memo').val(data.mahasiswa.memo).attr('disabled',true);
					$('#btnSubmit').attr('disabled',true);
				}
				else{
					if(data.mahasiswa!=null){
						$('#nama').val(data.mahasiswa.nama).attr('disabled',true);
						$('#no_telp').val(data.mahasiswa.no_telp).attr('disabled',false);
						$('#judul').val(data.mahasiswa.judul).attr('disabled',false);
						$('#pembimbing_1_id').val(data.mahasiswa.pembimbing_1_id).attr('disabled',false);
						$('#pembimbing_2_id').val(data.mahasiswa.pembimbing_2_id).attr('disabled',false);
						$('#memo').val(data.mahasiswa.memo).attr('disabled',false);
						$('#btnSubmit').attr('disabled',false);
					}
					else{
						$('#nama').val('').attr('disabled',false);
						$('#no_telp').val('').attr('disabled',false);
						$('#judul').val('').attr('disabled',false);
						$('#pembimbing_1_id').val('').attr('disabled',false);
						$('#pembimbing_2_id').val('').attr('disabled',false);
						$('#memo').val('').attr('disabled',false);
						$('#btnSubmit').attr('disabled',false);
					}
				}
			});
		});
	});
</script>
@endsection
