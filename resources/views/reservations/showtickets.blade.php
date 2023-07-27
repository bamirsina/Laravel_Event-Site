<!DOCTYPE html>
<html>
<head>
    <title>Check Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add any custom CSS styles here, if needed -->
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Check Your Ticket</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('checkTicket') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="ticket_code" class="form-label">Enter Your Ticket Code:</label>
                            <input type="text" name="ticket_code" id="ticket_code" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Check</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the Bootstrap JS and jQuery scripts (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
