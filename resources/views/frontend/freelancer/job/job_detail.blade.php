@extends('layouts.master')
@section('content')
    <!-- Intro -->
    <section id="portfolio" class="two">
        <div class="container">
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data['job']->created_at}}</span>
                        <h2>{{$data['job']->title}}</h2>
                        <p>
                            {!! $data['job']->description !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data['job']->budget}} Budget</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{$data['job']->totalBids()}} Applicants</div>
                        @if($data['job']->totalBids() != 0)
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data['job']->minBid()}} Lowest Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data['job']->avgBid()}} Average Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data['job']->maxBid()}} Highest Bid</div>
                        @endif
                    </div>
                </div>
            </div>
        @if($data['freelancer_bid'] != null)
            <h1 class="card-btn job_application_bar">My Proposal</h1>
            <br><br>
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data['freelancer_bid']->created_at}}</span>
                        <p>
                            {!! $data['freelancer_bid']->proposal !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data['freelancer_bid']->bid_amount}} Bit Amount</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{$data['freelancer_bid']->is_awarded == 0 ? "Not" : ""}} Awarded</div>
                    </div>
                </div>
            </div>
            @endif

            @if($data['job']->allow_bid === true)
                <form method="post" action="{{route('freelancer.job.bid')}}" enctype="multipart/form-data">
                    <div class="card row">
                        <div class="card-content">
                            <div class="col-sm-9">
                                <h1 class="card-btn job_application_bar">Bid for this project</h1>
                                @csrf
                                <input type="hidden" name="job_id" value="{{$data['job']->job_id}}">
                                <input type="text" name="bid_amount" class="input-group">
                                <textarea name="proposal" class="input-group"> </textarea>
                            </div>
                            <div class="col-sm-3">
                                <button class="card-btn" type="submit">Submit</button>
                                <hr>
                            </div>

                        </div>
                    </div>
                </form>
            @endif


        </div>
    </section>
@endsection