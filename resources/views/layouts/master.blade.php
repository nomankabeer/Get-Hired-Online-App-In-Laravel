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
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="{{asset('images/avatar.jpg')}}" alt="" /></span>
							<h1 id="title">Jane Doe</h1>
							<p>Hyperspace Engineer</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link"><span class="icon fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link"><span class="icon fa-th">Portfolio</span></a></li>
								<li><a href="#about" id="about-link"><span class="icon fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link"><span class="icon fa-envelope">Post a Job</span></a></li>
							</ul>
						</nav>

				</div>

				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>

				</div>

			</div>

		<!-- Main -->
			<div id="main">
<div id="app"></div>
				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt">Hi! I'm <strong>Prologue</strong>, a <a href="http://html5up.net/license">free</a> responsive<br />
								site template designed by <a href="http://html5up.net">HTML5 UP</a>.</h2>
								<p>Ligula scelerisque justo sem accumsan diam quis<br />
								vitae natoque dictum sollicitudin elementum.</p>
							</header>

							<footer>
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
							</footer>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<div class="card row">
								<div class="card-content">

									<div>

										<span class="card-date">31 March 2019</span>
										<h2>Title</h2>
										<p>
											Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel repudiandae eos provident fugit aliquid atque architecto fugiat a nesciunt aut, ipsa sed tenetur sint eligendi veniam iusto autem numquam? Distinctio!
										</p>
										<br/>
										<a href="https://news.google.com" class="card-btn" target="_blank">Read Full Article</a>
									</div>
								</div>
							</div>









							<div class="card row">
								<div class="card-content">
									<div class="card-thumb">
										Noman Kabeer
										<img src="{{asset('images/pic02.jpg')}}" alt=''>
										<div>im php and laravel developer and i worked on vue js as well</div>
										<span class="badge badge-pill badge-background text-white">php</span>
										<span class="badge badge-pill badge-background text-white">python</span>
										<span class="badge badge-pill badge-background text-white">javascript</span>
										<span class="badge badge-pill badge-background text-white">Ruby</span>
										<span class="badge badge-pill badge-background text-white">php</span>
									</div>
									<div>

										<span class="card-date">31 March 2019</span>
										<h2>Title</h2>
										<p>
											Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel repudiandae eos provident fugit aliquid atque architecto fugiat a nesciunt aut, ipsa sed tenetur sint eligendi veniam iusto autem numquam? Distinctio!
										</p>
										<br/>
										<a href="https://news.google.com" class="card-btn" target="_blank">Read Full Article</a>
									</div>
								</div>
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							<a href="#" class="image featured"><img src="{{asset('images/pic08.jpg')}}" alt="" /></a>

							<p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus
							ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae
							laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem
							parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper
							dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec
							ornare iaculis.</p>

						</div>
					</section>

				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Post a Job</h2>
							</header>
							<form method="post" action="#">
								<div class="row">
									<div class="col-6 col-12-mobile"><input type="text" name="name" placeholder="Job Title" /></div>
									<div class="col-6 col-12-mobile"><input type="text" name="email" placeholder="Job Budget" /></div>
									<div class="col-12">
										{{--<textarea name="message" placeholder="Message"></textarea>--}}
                                        <textarea class="content" name="example"></textarea>
									</div>
									<div class="col-12">
										<input type="submit" value="Post a Job" />
									</div>
								</div>
							</form>

						</div>
					</section>

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