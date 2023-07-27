<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tickets</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tickets.css') }}">
</head>
<body>
<!-- Your page content goes here -->

<!-- JavaScript links (if needed) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<div class="container-fluid full-height">
    <div class="row full-height justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Posts</div>
                <a class="btn btn-primary" href="{{ route('web.events') }}">Back</a>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>The Guests</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{$ticket->id }}</td>
                                    <td>{{$ticket->full_name }}</td>
                                    <td>{{$ticket->email }}</td>
                                    <td>{{$ticket->status }}</td>
                                    <td class="">
                                        @if($ticket->status === 'pending')
                                            <!-- The ticket is pending -->
                                            <!-- Hide the Show button -->
                                            <button class="btn btn-success" style="display:none;">Show</button>
                                        @elseif($ticket->status === 'approved')
                                            <!-- The ticket is approved -->
                                            <a class="btn btn-success" href="{{ route('web.show_ticket', $ticket->id) }}">Show</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

