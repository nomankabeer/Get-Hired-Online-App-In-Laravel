@extends('layouts.master')
@section('content')
    <!-- Contact -->
    <section id="contact" class="four">
        <div class="container">
            <header>
                <h2>Post a Job</h2>
            </header>
            <form method="post" action="{{route('client.job.post')}}">
                @csrf
                <div class="row">
                    <div class="col-6 col-12-mobile"><input type="text" name="title" placeholder="Job Title" /></div>
                    <div class="col-6 col-12-mobile"><input type="text" name="budget" placeholder="Job Budget" /></div>
                    <div class="col-12">
                        {{--<textarea name="message" placeholder="Message"></textarea>--}}
                        <textarea class="content" name="description"></textarea>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Post a Job" />
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection