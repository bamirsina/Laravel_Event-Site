@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card">
                <div class="card-header">Posts
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">New post</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>The Guests</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->event_name }}</td>
                                <td>{{ $post->the_guests }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('posts.show',$post->id) }}">Show</a>
                                    @can('post-edit')
                                        <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                    @endcan
                                    @can('post-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $data->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
