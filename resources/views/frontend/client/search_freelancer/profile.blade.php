@extends('layouts.master')

@section('content')
    <!-- Intro -->
    <section id="top" class="one dark cover paddingNone">
        <div class="parent">
            <div class="box-one">
                <h1>
                    <span class="color-secondary">{{$data['user_detail']->userDetail->title}}</span>

                </h1>
                <div style="margin-top:50px;">
                    <a class="contact-link" target="_blank" href="https://www.instagram.com/akhtar_sheraliat/"> Contact
                        Me</a></div>
            </div>
            <div class="box-two">
                <div class="profile_image">
                    <img class="profile_img" src="{{asset('storage/images/userProfile').'/'.$data['user_detail']->avatar}}">
                </div>
                <span class="card-title modal-title">{{$data['user_detail']->userDetail->first_name}} {{$data['user_detail']->userDetail->last_name}}</span>
            </div>
        </div>
    </section>
    <!-- About Me -->
    <section  class="one">
        <div class="uk-card uk-card-default uk-card-body uk-width-1">
            <div class="uk-card-badge uk-labefl">
            </div>
            <h3 class="uk-card-title">About ME</h3>
            <p>{!! $data['user_detail']->userDetail->about_me !!}</p>
        </div>
<br>
        <div class="uk-card uk-card-default uk-card-body uk-width-1">
            <div class="uk-card-badge uk-labefl">
            </div>
            <h3 class="uk-card-title">Education</h3>

            <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-child-width-1-3@s" uk-grid>
                    @if($data['user_detail']->userDetail->userEducation != null)
                    @foreach($data['user_detail']->userDetail->userEducation as $education)
                            <div>
                                <div class="uk-card uk-card-default uk-card-small uk-card-body">
                                    <h3 class="uk-card-title">{{$education->degree_title}}</h3>
                                    <p>{{$education->start_date}} - {{$education->end_date}} </p>
                                    <p>{{$education->description}}</p>
                                </div>
                            </div>
                    @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="uk-card uk-card-default uk-card-body uk-width-1">
            <h3 class="uk-card-title">Experience</h3>
            <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
                <div>
                    <div class="uk-child-width-1-3@s" uk-grid>
                        @if($data['user_detail']->userDetail->userExperience != null)
                            @foreach($data['user_detail']->userDetail->userExperience as $experience)
                                <div>
                                    <div class="uk-card uk-card-default uk-card-small uk-card-body">
                                        <h3 class="uk-card-title">{{$experience->title}}</h3>
                                        <p>{{$experience->start_date}} - {{$experience->end_date}} </p>
                                        <p>{{$experience->description}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="uk-card uk-card-default uk-card-body uk-width-1">
            <h3 class="uk-card-title">Skills</h3>
            <p>
                @if($data['user_detail']->userDetail->skills != null)
                    @foreach($data['user_detail']->userDetail->skills as $skill)
                        {{$skill->name}} -
                    @endforeach
                @endif
            </p>
        </div>

    </section>

<hr>
    <section  class="one">

        <h3 class="uk-card-title">Job Reviews</h3>


        <div class="uk-card uk-card-default uk-width-1">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-border-circle" width="40" height="40" src="images/avatar.jpg">
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">JOB Title</h3>

                        <div>
                            <div class="uk-child-width-1" uk-grid>
                                @if($data['order_detail'] != null)
                                    @foreach($data['order_detail'] as $order_detail)
                                        <div>
                                            <div class="uk-card uk-card-default uk-card-small uk-card-body">
                                                <h3 class="uk-card-title">{{$order_detail->jobDetail->title}}</h3>
                                                @if($order_detail->status == $orderCompletedId)
                                                    @if($order_detail->client_rating != null)
                                                        <p>{{$order_detail->client_review}}</p>
                                                        <p>{{$order_detail->client_rating}}</p>
                                                    @endif
                                                        @if($order_detail->freelancer_rating != null)
                                                            <p>{{$order_detail->freelancer_review}}</p>
                                                            <p>{{$order_detail->freelancer_rating}}</p>
                                                        @endif

                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>


                     </div>
                </div>
            </div>

        </div>

        <br>




    </section>





@endsection