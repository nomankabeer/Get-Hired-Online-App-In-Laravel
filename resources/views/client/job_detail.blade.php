@extends('layouts.master')

@section('content')
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
                    </div>
                    <div>
                        <div href="https://news.google.com" class="card-btn" target="_blank">20 Applicants</div>
                        <hr>
                        <div href="https://news.google.com" class="card-btn" target="_blank">$250 Average Bid</div>
                        <hr>
                        <div href="https://news.google.com" class="card-btn" target="_blank">$250 Highest Bid</div>
                    </div>
                </div>
            </div>
            <h1 class="card-btn job_application_bar">Job Applicants</h1>
            <br><br>


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
                        <h2>25$</h2>
                        <h2> <h1 class="card-btn highlighted_job_btn">500$</h1></h2>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel repudiandae eos provident fugit aliquid atque architecto fugiat a nesciunt aut, ipsa sed tenetur sint eligendi veniam iusto autem numquam? Distinctio!
                        </p>
                        <br/>
                        <a href="https://news.google.com" class="card-btn" target="_blank">Award Job</a>
                    </div>
                </div>
            </div>





            <div class="card row" >
                <div class="card-content awarded_job" >
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
                        <h2> <h1 class="card-btn highlighted_job_btn">500$</h1></h2>

                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel repudiandae eos provident fugit aliquid atque architecto fugiat a nesciunt aut, ipsa sed tenetur sint eligendi veniam iusto autem numquam? Distinctio!
                        </p>
                        <br/>
                        <h1 class="card-btn awarded_job_btn">Awarded</h1>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

{{--    <section id="about" class="three">
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
    </section>--}}



@endsection