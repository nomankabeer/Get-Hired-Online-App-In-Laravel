@extends('layouts.master')
@section('content')
    <!-- Intro -->
    <section id="portfolio" class="two">
        <div class="container">
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data->jobDetail->created_at}}</span>
                        <h2>{{$data->jobDetail->title}}</h2>
                        <p>
                            {!! $data->jobDetail->description !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data->jobDetail->budget}} Budget</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{$data->jobDetail->totalBids()}} Applicants</div>
                        @if($data->jobDetail->totalBids() != 0)
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobDetail->minBid()}} Lowest Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobDetail->avgBid()}} Average Bid</div>
                        <hr>
                        <div  class="card-btn" target="_blank">${{$data->jobDetail->maxBid()}} Highest Bid</div>
                        @endif
                    </div>
                </div>
            </div>
        @if($data->bidDetail != null)
            <h1 class="card-btn job_application_bar">My Proposal</h1>
            <br><br>
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <span class="card-date">{{$data->bidDetail->created_at}}</span>
                        <p>
                            {!! $data->bidDetail->proposal !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data->bidDetail->bid_amount}} Bit Amount</div>
                        <hr>
                        <div  class="card-btn" target="_blank"> {{$data->bidDetail->is_awarded == 0 ? "Not" : ""}} Awarded</div>
                    </div>
                </div>
            </div>
        @endif

            @if($data->orderDeliveries != null)
                <h1 class="card-btn job_application_bar">Deliveries</h1>
                <br><br>
                @foreach($data->orderDeliveries as $delivery)
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
                            <div  class="card-btn" >{{$delivery->orderStatus}}</div>
                            <hr>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

            @if($data->allow_delivery == true)
                <form method="post" action="{{route('freelancer.order.delivery')}}" enctype="multipart/form-data">
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                            @csrf
                        <input type="hidden" name="order_id" value="{{$data->order_id}}">
                        <textarea name="content" class="input-group"> </textarea>
                        <input type="file" name="file" class="input-group">
                    </div>
                    <div class="col-sm-3">
                        <button class="card-btn" type="submit">Submit</button>
                        <hr>
                    </div>

                </div>
            </div>
                </form>
            @elseif($data->allow_delivery == false)
                <h1 class="card-btn job_application_bar">{{$data->order_status}}</h1>
            @endif


        </div>
    </section>
@endsection