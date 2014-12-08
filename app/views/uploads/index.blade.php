@extends('layouts.default')	

@section('content')

<div class="container" style="padding:15px;">

      <div class="template-lol">
       		<form action="{{ route('upload') }}" method="post" id="pikadrop" enctype="multipart/form-data" class="dropzone">
				<div class="fallback">
		    		<input name="img" type="file" multiple />
		    		{{ Form::submit('upload !') }}
		 		</div>
			</form>
			<form class="form-inline" role="form" style="padding:15px;">
		  <div class="form-group">
		  	<label class="sr-only" for="url">Url</label>
		    <input type="text" class="form-control" id="url" placeholder="Upload from url" style="width:100%">
		  </div>
		  <button type="submit" data-url="{{ route('upload.remote') }}" class="btn btn-default" id="upload-url">Go</button>
		</form>
			<p class="lead">
			No porn No violence jpg/gif/png 5Mo <br />
			Don't abuse. 
			</p>
			<p>
			<div id="result-list" class="form-group">
			 </div>
			</p>
      </div>
</div>


	


@stop


@section('js')
{{ HTML::script('assets/js/upload.js') }}
@stop