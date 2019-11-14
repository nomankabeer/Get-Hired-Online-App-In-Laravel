<!DOCTYPE HTML>
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{asset('css/app.css')}}" />
		<link rel="stylesheet" href="{{asset('css/main.css')}}" />
		<link rel="stylesheet" href="{{asset('rich_text_area/richtext.min.css')}}" />
<style>
	.parent {
		background-color: #252E3B;
		height: 400px;
		display: flex;
	}
	h1 {
		margin: 0px;
		font-family: monospace;
	}
	.box-one {
		width: 35%;
		color: white;
		background-color: #252E3B;
		padding: 50px;
	}
	.box-two {
		width: 80%;
		background: linear-gradient(-57deg, #F0DA50 63%, #252E3B 42%);
		color: white;
	}
	img {
		max-width: 100%;
		height: auto;
		border-radius: 50%;
		border: 3px solid #F0DA50;
	}
	.image {
		height: 250px;
		width: 250px;
		border-radius: 50%;
		margin-top: 8%;
		margin-left: 27%;
	}
	.color-secondary, a {
		color: #F0DA50;
		text-decoration: none;
	}
	.contact-link {
		padding: 10px 30px;
		background: #F7DF1E;
		border-radius: 5px;
		font-family: monospace;
		font-weight: 700;
		font-size: 18px;
		color: #000000;
	}
</style>

	</head>
	<body class="is-preload">

		<!-- Header -->
			@include('partials.sidebar')
        <div id="app">
		<!-- Main -->
        <div id="main">
            @yield('content')
			</div>
        </div>
		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

			</div>


		<!-- Scripts -->
			<script src="{{asset('js/jquery.min.js')}}"></script>
			<script src="{{asset('js/jquery.scrolly.min.js')}}"></script>
			<script src="{{asset('js/jquery.scrollex.min.js')}}"></script>
			<script src="{{asset('js/browser.min.js')}}"></script>
			<script src="{{asset('js/breakpoints.min.js')}}"></script>
			<script src="{{asset('js/util.js')}}"></script>
			<script src="{{asset('js/main.js')}}"></script>
			<script src="{{asset('js/app.js')}}"></script>



			<script src="{{asset('rich_text_area/jquery.richtext.js')}}"></script>
			<script src="{{asset('rich_text_area/jquery.richtext.min.js')}}"></script>
        <script>
            $('.content').richText();

        </script>
	</body>
</html>