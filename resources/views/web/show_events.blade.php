<!DOCTYPE html>
<html>
<head>
    <title>User Details Form</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add your custom CSS file -->
    <link rel="stylesheet" href="{{ asset('css/layouts.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">User Details Form</h1>
    <a class="btn btn-primary mb-3" href="{{ route('web.events') }}">Back</a>
    <div class="row">
        <div class="col-md-6">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{route('web.show_events.store')}}" method="POST">
                @csrf
                <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="number">Number:</label>
                    <input type="number" id="number" name="number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="zone">Select Zone:</label>
                    <select name="zone" id="zone" class="form-control" onchange="updatePrice()">
                        @foreach ($zones as $key => $zone)
                            <option value="{{ $zone->id }}" data-price="{{ $zone->price }}">{{ $zone->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="people">Number of Persons:</label>
                    <input type="number" name="people" id="people" class="form-control" onchange="updatePrice()" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <img src="{{ asset($post->logo_path) }}" style="width: 200px; height: 200px;" class="mb-3">
            <h3>Event Name:</h3>
            <p>{{ $post->event_name }}</p>
            <h3>The Guests:</h3>
            <p>{{ $post->the_guests }}</p>
            <h3>Club Name:</h3>
            <p>{{ $post->club_name }}</p>
            <h3>Club Location:</h3>
            <p>{{ $post->club_location }}</p>
            <h3>Started At:</h3>
            <p>{{ $post->datetime }}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div id="zone-price" class="text-success"></div>
            <div id="total-price" class="text-info"></div>
        </div>
    </div>
</div>
<!-- Add Bootstrap JS script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Your existing JavaScript function -->
<script>
    function updatePrice() {
        // ... Your existing JavaScript function ...
    }
</script>
</body>
</html>
