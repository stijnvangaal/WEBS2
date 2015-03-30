<!doctype html>
<html lang="en">
<head>
		<meta charset="UTF-8">
</head>

@include('Header')

<body>
	<div class="ContentContainer">
		@if(Session::has('message'))
			<div class="flash alert">
				<p>{{ Session::get('message') }}</p>
			</div>
		@endif

		@yield('content')
	</div>
</body>

@include('Footer')