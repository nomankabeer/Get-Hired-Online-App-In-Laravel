@extends('layouts.master')
@section('content')
    <!-- Intro -->
    <section id="portfolio" class="two">
        <div class="container">

            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data->created_at}}</span>
                        <h2>{{$data->title}}</h2>
                        <p>
                            {!! $data->description !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data->budget}} Budget</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{($data->jobBids->count())}} Applicants</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobBids->min('bid_amount')}} Lowest Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobBids->avg('bid_amount')}} Average Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobBids->max('bid_amount')}} Highest Bid</div>
                    </div>
                </div>
            </div>
            <h1 class="card-btn job_application_bar">Job Applicants</h1>
            <br><br>

            @foreach($data->jobBids as $bids)
            <div class="card row">
                <div class="card-content">
                    @if($bids->userDetail != null)
                    <div class="card-thumb">
                        {{$bids->userDetail->first_name}} {{$bids->userDetail->last_name}}
                        <img src="{{asset('images/pic02.jpg')}}" alt=''>
                        <div>{{$bids->userDetail->title}}</div>
                        @foreach($bids->userDetail->user_skills as $skill)
                        <span class="badge badge-pill badge-background text-white">{{$skill}}</span>
                        @endforeach
                    </div>
                    @endif
                    <div>

                        <span class="card-date">{{$bids->created_at}}</span>
                        @if($data->jobBids->max('bid_amount') == $bids->bid_amount || $bids->is_awarded == 1 )
                        <h2> <h1 class="card-btn highlighted_job_btn">${{$bids->bid_amount}}</h1></h2>
                        @else
                        <h2>${{$bids->bid_amount}}</h2>
                        @endif
                        <p>
                            {{$bids->proposal}}
                        </p>
                        <br/>
                        @if($bids->is_awarded == 1)
                        <h1  class="card-btn awarded_job_btn ">Awarded</h1>
                        @elseif($data->job_is_awarded != 1)
                        <a href="{{route('client.job.award' , [ $data->id , $bids->id])}}" class="card-btn" >Award Job</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection