@if (session('status'))
<div class="col-xs-12">
	<div class="alert alert-info">
      <h4><span class='fa fa-info'></span> Informasi</h4>
      <p>{{ session('status') }}</p>
    </div>
</div>
@endif