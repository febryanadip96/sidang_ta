@if (count($errors) > 0)
<div class="col-xs-12">
	<div class="alert alert-danger">
      <h4><span class='fa fa-warning'> Kesalahan</h4>
	    @foreach ($errors->all() as $error)
	        <p>{{ $error }}</p>
	    @endforeach
    </div>
</div>
@endif