<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pour un monde meilleure</title>
	{{ HTML::style('assets/css/dropzone.css')}}
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	{{ HTML::style('assets/css/bootstrap-modal-bs3patch.css')}}
	{{ HTML::style('assets/css/bootstrap-modal.css')}}
	{{ HTML::style('assets/css/colorbox.css')}}
	{{ HTML::style('assets/css/selectize.bootstrap3.css')}}
	{{ HTML::style('assets/css/main.css')}}
</head>
<body>

	@yield('content')

</body>
	{{ HTML::script('assets/js/jquery-1.11.0.min.js')}}
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	{{ HTML::script('assets/js/dropzone.min.js')}}
	{{ HTML::script('assets/js/bootstrap-modalmanager.js')}}
	{{ HTML::script('assets/js/bootstrap-modal.js')}}
	{{ HTML::script('assets/js/selectize.min.js')}}
	{{ HTML::script('assets/js/jquery.colorbox-min.js')}}


	@yield('js')
</html>