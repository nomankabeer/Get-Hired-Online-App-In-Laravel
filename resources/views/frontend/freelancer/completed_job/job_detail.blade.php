@extends('layouts.master')
@section('content')
    {{--{{dd($data)}}--}}
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
        @if($data['bid'] != null)
            <h1 class="card-btn job_application_bar">My Proposal</h1>
            <br><br>
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data['bid']->created_at}}</span>
                        <p>
                            {!! $data['bid']->proposal !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data['bid']->bid_amount}} Bit Amount</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{$data['bid']->is_awarded == 0 ? "Not" : ""}} Awarded</div>
                    </div>
                </div>
            </div>
                @endif


            @if($data['order']->orderDeliveries != null)
                <h1 class="card-btn job_application_bar">Deliveries</h1>
                <br><br>
                @foreach($data['order']->orderDeliveries as $delivery)
                    <div class="card row">
                        <div class="card-content">
                            <div class="col-sm-9">
                                <span class="card-date">{{$delivery->created_at}}</span>
                                <p>
                                    {!! $delivery->content !!}
                                </p>
                                <p>
                                    {!! $delivery->file !!}
                                </p>
                                <br/>
                            </div>
                            <div class="col-sm-3">
                                <div  class="card-btn" >{{$delivery->order_status}}</div>
                                <hr>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if($data['order']->client_rating != null)
                <div class="card row">

                        <div class="card-content">
                            <div class="col-sm-6">
                                Client Review: {{$data['order']->client_rating}} -
                                {{$data['order']->client_review}}
                            </div>
                            <div class="col-sm-6">
                                Freelancer Review: {{$data['order']->freelancer_rating}} -
                                {{$data['order']->freelancer_review}}
                            </div>
                        </div>

                </div>
            @endif
            @if($data['order']->freelancer_rating == null)
                <div class="card row">
                <form method="post" action="{{route('freelancer.order.review')}}">
                    @csrf
                    <div class="card-content">
                        <div class="col-sm-9">
                            <h1 class="card-date">Review</h1>
                            <input type="text" name="freelancer_review">
                            <input type="hidden" name="order_id" value="{{$data['order']->order_id}}">
                            <select name="freelancer_rating"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>

                        </div>
                        <div class="col-sm-3">
                            <div  ><button class="card-btn" type="submit">Submit</button></div>
                            <hr>
                        </div>
                    </div>
                </form>
                    </div>
            @endif
                <h1 class="card-btn job_application_bar">{{$data['order']->order_status}}</h1>




        </div>
    </section>
@endsection