<!DOCTYPE html>
<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<title>Project Flyer</title>
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/css/libs.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">ProjectFlyer</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>

					</ul>
					@if($signedIn)
						<p class="navbar-text navbar-right">
							Hello,{{$user->name}}
						</p>
					@endif
				</div>
			</div>
		</nav>
		<div class="container">
			@yield('content')
		</div>
		<script src="/js/libs.js"></script>
		@yield('script.footer')
		@include('flash')
	</body>
</html>
