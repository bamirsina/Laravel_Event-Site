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
{{--                    @can('role-create')--}}
{{--                        <span class="float-right">--}}
{{--                        <a class="btn btn-primary" href="{{ route('posts.create') }}">New post</a>--}}
{{--                    </span>--}}
{{--                    @endcan--}}
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>The Guests</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{$ticket->id }}</td>
                                <td>{{$ticket->full_name }}</td>
                                <td>{{$ticket->email }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('reservations.show', $ticket->id) }}">Show</a>

                                    @if(auth()->user()->is_admin && $ticket->status === 'pending')
                                        <form action="{{ route('approve.ticket') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                            <select name="is_approved" class="form-group">
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            <input type="hidden" name="status" value="pending">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </form>
                                    @elseif($ticket->status === 'approved')
                                        <p>Status: Approved</p>
                                    @elseif($ticket->status === 'not approved')
                                        <p>Status: Not Approved</p>
                                    @else
                                        <p>Status: Pending</p>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    {{ $data->appends($_GET)->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
