<!DOCTYPE html>
<html>
<head>
	<title>TODO List</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
<h1 class="text-center text text-primary">Todo List</h1>
<hr><br><br>
<div class="container">
	<div class="col-md-6 col-md-offset-3">
		@yield('content')	
	</div>
</div>
</body>
</html>