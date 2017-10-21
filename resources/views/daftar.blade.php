@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>

<!-- Main content -->
<section class="content">
  	<div class="box box-danger">
		<div class="box-header with-border">
			<div class="text-center">
				<h3 class="box-title">Pendaftaran Sidang Tugas Akhir Periode ...-...</h3><br>
				<b>Batas Pendaftaran :</b>
			</div>
		</div>
		<div class="box-body">
	    @if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
	    @endif
			<form class="form-horizontal" method="POST" action="{{ url('daftar') }}">
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
							<input id="no_telp" type="text" class="form-control" name="no_telp" required>
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
						<input id="pembimbing_1_id" type="text" class="form-control" name="pembimbing_1_id" required>
					</div>
	            </div>

				<div class="form-group">
					<label for="pembimbing_2_id" class="col-md-4 control-label">Pembimbing 2</label>
					<div class="col-md-6">
						<input id="pembimbing_2_id" type="text" class="form-control" name="pembimbing_2_id" required>
					</div>
	            </div>

				<div class="form-group">
					<label for="memo" class="col-md-4 control-label">Memo</label>
					<div class="col-md-6">
						<textarea id="memo" class="form-control" name="memo" cols="3"></textarea>
					</div>
	            </div>

	            <div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						<button type="submit" class="btn btn-danger">
							Daftar
						</button>
					</div>
	            </div>
			</form>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->
<div class="container">

</div>
@endsection
