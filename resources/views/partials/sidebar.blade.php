<div id="header">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar48"><img src="{{asset('images/avatar.jpg')}}" alt="" /></span>
            <h1 id="title">{{Auth::user()->name}}</h1>
            <p>Hyperspace Engineer</p>
        </div>

        <!-- Nav -->
        <nav id="nav">
            @if(Auth::user()->role_id == $clientRoleId)
                <ul>
                    <li><a href="{{route('index')}}" id="top-link"><span class="icon fa-home">Intro</span></a></li>
                    {{--<li><a href="{{route('index')}}" id="portfolio-link"><span class="icon fa-th">Portfolio</span></a></li>--}}
                    <li><a href="{{route('index')}}" id="about-link"><span class="icon fa-user">About Me</span></a></li>
                    <li><a href="{{route('client.job.post')}}" id="contact-link"><span class="icon fa-envelope">Post a Job</span></a></li>
                    <li><a href="{{route('client.job.list')}}" id="contact-link"><span class="icon fa-envelope">My Job List</span></a></li>
                    <li><a href="{{route('client.orders.list')}}" id="contact-link"><span class="icon fa-envelope">My Order List</span></a></li>
                    <li><a href="{{route('client.search.freelancer')}}" id="contact-link"><span class="icon fa-envelope">Search Freelancer</span></a></li>
                    <li><a href="{{route('logout')}}" id="contact-link"><span class="icon fa-envelope">Logout</span></a></li>
                </ul>
            @elseif(Auth::user()->role_id == $freelancerRoleId)
            <ul>
                <li><a href="{{route('freelancer.profile')}}" id="top-link"><span class="icon fa-home">Profile</span></a></li>
                <li><a href="{{route('freelancer.job.view')}}" id="portfolio-link"><span class="icon fa-th">Jobs</span></a></li>
                <li><a href="{{route('freelancer.applied.job.list.view')}}" id="portfolio-link"><span class="icon fa-th">Applied Jobs</span></a></li>
                <li><a href="{{route('freelancer.active.order.list.view')}}" id="portfolio-link"><span class="icon fa-th">Active Orders</span></a></li>
                <li><a href="{{route('freelancer.completed.job.list.view')}}" id="portfolio-link"><span class="icon fa-th">completed Jobs</span></a></li>
                <li><a href="{{route('freelancer.cancelled.job.list.view')}}" id="portfolio-link"><span class="icon fa-th">Cancelled Jobs</span></a></li>
                <li><a href="{{route('logout')}}" id="portfolio-link"><span class="icon fa-th">Logout</span></a></li>
            </ul>
        </nav>
        @endif

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