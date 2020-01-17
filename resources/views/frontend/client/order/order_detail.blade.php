@extends('layouts.master')
@section('content')
    <!-- Portfolio -->
    <section id="portfolio" class="two">
        <div class="container">

            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <h1 class="card-date">J0b Detail</h1>
                        <span class="card-date">{{$data->created_at}}</span>
                        <h2>{{$data->jobDetail->title}}</h2>
                        <p>
                            {!! $data->jobDetail->description !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data->jobDetail->budget}} Budget</div><br>
                        <div  class="card-btn" target="_blank">Status: {{$data->order_status}}</div><br>
                        <hr>
                    </div>
                </div>
            </div>



            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <h1 class="card-date">Bid Detail</h1>
                        <span class="card-date">{{$data->created_at}}</span>
                        <h2>{{$data->bidDetail->userDetail->first_name}} {{$data->bidDetail->userDetail->last_name}}</h2>
                           <br>
                            {!! $data->bidDetail->proposal !!}
                        </p>
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">${{$data->bidDetail->bid_amount}} Bid</div>
                        <hr>
                    </div>
                </div>
            </div>


            @foreach($data->orderDeliveries as $deliveries)
            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <h1 class="card-date">Order Deliveries</h1>
                        <span class="card-date">{{$deliveries->created_at}}</span><br>
                        {!! $deliveries->content !!}
                        <br/>
                    </div>
                    <div class="col-sm-3">
                        <div  class="card-btn" target="_blank">{{$deliveries->orderStatus}}</div>
                        @if($deliveries->status === $orderDeliveryStatusPendingId)
                        <br>
                        <a class="card-btn" href="{{route('client.order.update.delivery.status' , [$deliveries->id , $orderDeliveryStatusAcceptedId])}}" style="color: #FFFFFF;">Accept</a>
                        <br>
                        <a  class="card-btn"  href="{{route('client.order.update.delivery.status' , [$deliveries->id , $orderDeliveryStatusRejectedId])}}" style="color: #FFFFFF;" >Reject</a>
                        @endif
                        <hr>
                    </div>
                </div>
            </div>
            @endforeach

            @if($data->status == $orderCompletedId && $data->client_review == null && $data->client_rating == null)
            <div class="card row">
                <form method="post" action="{{route('client.order.review')}}">
                    @csrf
                <div class="card-content">
                    <div class="col-sm-9">
                        <h1 class="card-date">Review</h1>
                        <input type="text" name="client_review">
                        <input type="hidden" name="order_id" value="{{$data->order_id}}">
                        <select name="client_rating"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>

                    </div>
                    <div class="col-sm-3">
                        <div  ><button class="card-btn" type="submit">Submit</button></div>
                        <hr>
                    </div>
                </div>
                </form>
            </div>
             @elseif($data->status == $orderCompletedId && $data->client_review != null && $data->client_rating != null)
                <div class="card row">

                        <div class="card-content">
                            <div class="col-sm-6">
                                <h1 class="card-date">Client Review</h1>
                     {{$data->client_review}}<br>
                                {{$data->client_rating}}
                            </div>
                            <div class="col-sm-6">
                                <h1 class="card-date">Freelancer Review</h1>
                                {{$data->freelancer_review}}<br>
                                {{$data->freelancer_rating}}
                            </div>

                        </div>

                </div>
            @endif


        </div>
    </section>
@endsection
@push('script')

@endpush