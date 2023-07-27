<br>
<br>
<br>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{asset('css/reservation.css')}}" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->
@extends('layouts.master')
@section('content')
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{ asset($post->logo_path) }}" width="200px" height="200px" alt="Logo"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h2 style="color: forestgreen">
                            NEW RESERVATION
                        </h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('reservations.index') }}">Back</a>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <h5 style="color: blue">Event Name:</h5> {{ $post->event_name }}<br/><br/>
                        <h5 style="color: blue">The Guests:</h5> {{ $post->the_guests }}<br/><br/>
                        <h5 style="color: blue">Club Name:</h5> {{ $post->club_name }}<br/><br/>
                        <h5 style="color: blue">Club Location:</h5> {{ $post->club_location }}<br/><br/>
                        <h5 style="color: blue">Started At:</h5> {{ $post->datetime }}<br/><br/>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Full Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->full_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Number</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->number }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Age</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->age }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>People</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->people }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Zone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->zone }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Zone Price</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->zone_price }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Total Price</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $ticket->total_price }}</p>
                                </div>
                            </div>


                            <!-- Other ticket details... -->
                        </div>
                    </div>
                    <br>
                    <!-- Approval buttons -->
                    @if ($post->status == 'approved')
                        <form action="{{ route('reservations.disapprove', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit">Disapprove</button>
                        </form>
                    @elseif ($post->status == 'disapproved')
                        <form action="{{ route('reservations.approve', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                    @else
{{--                        <form action="{{ route('reservations.approve', $post->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button type="submit">Approve</button>--}}
{{--                        </form>--}}
{{--                        <form action="{{ route('reservations.disapprove', $post->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button type="submit">Disapprove</button>--}}
{{--                        </form>--}}
                    @endif

                </div>
            </div>
        </form>
    </div>
@endsection
