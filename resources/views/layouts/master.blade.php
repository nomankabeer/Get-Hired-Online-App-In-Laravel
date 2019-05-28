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