@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Post
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <img src="{{ asset($post->logo_path) }}" style="width: 300px; height: 200px;" alt="Logo">
                    </div>
                    <div class="lead">
                        <strong>Event Name:</strong>
                        {{ $post->event_name }}
                    </div>
                    <div class="lead">
                        <strong>The Guests:</strong>
                        {{ $post->the_guests }}
                    </div>
                    <div class="lead">
                        <strong>Club Name:</strong>
                        {{ $post->club_name }}
                    </div>
                    <div class="lead">
                        <strong>Club Location:</strong>
                        {{ $post->club_location }}
                    </div>
                    <div class="lead">
                        <strong>Zone:</strong>
                        {{ $post->zone }}
                    </div>
                    <div class="lead">
                        <strong>Started At:</strong>
                        {{ $post->datetime }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
