@if (session('status'))
<div class="col-xs-12">
	<div class="alert alert-info">
      <h4><span class='fa fa-info'></span> Informasi</h4>
      <p>{{ session('status') }}</p>
    </div>
</div>
@endif
@if (session('error'))
<div class="col-xs-12">
	<div class="alert alert-danger">
      <h4><span class='fa fa-warning'></span> Error</h4>
      <p>{{ session('error') }}</p>
    </div>
</div>
@endif