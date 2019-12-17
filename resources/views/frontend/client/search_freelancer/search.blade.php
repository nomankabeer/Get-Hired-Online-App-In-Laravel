@extends('layouts.master')
@section('content')
    <!-- Portfolio -->
    <section id="portfolio" class="two">
        <div class="container">

            <div class="card row">
                <div class="card-content">
                    <div class="col-sm-9">
                        <h1 class="card-date">Search</h1>
                        {{--<span class="card-date">{{$data->created_at}}</span>--}}
                        <h2>Search</h2>
                        <form method="post" action="{{route('client.search.freelancer')}}" >
                            @csrf
                            <input type="hidden" name="search" value="1">
                            <input type="text" name="title" placeholder="Search By Title">
                            <select multiple name="skill[]">
                                @foreach($data['skills'] as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                                @endforeach
                            </select>

                            <button type="submit">Submit</button>
                        </form>
                        <br/>
                    </div>
                    <div class="col-sm-3">
{{--                        <div  class="card-btn" target="_blank">${{$data->jobDetail->budget}} Budget</div><br>--}}
                        {{--<div  class="card-btn" target="_blank">Status: {{$data->order_status}}</div><br>--}}
                        <hr>
                    </div>
                </div>
            </div>
            @if(array_key_exists('data' , $data ))
            @foreach($data['data'] as $user)
            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-3@s uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="images/light.jpg" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title">{{$user->title}}</h3>
                        <p></p>
                    </div>
                    <a href="{{route('client.search.freelancer.profile', $user->userName->name )}}">visit profile</a>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </section>

@endsection
@push('script')

@endpush