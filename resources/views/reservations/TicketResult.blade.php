<!-- resources/views/ticket_result.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Ticket Result</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the result container */
        .result-container {
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .approved {
            background-color: #b3ffb3; /* Light green */
        }
        .not-approved {
            background-color: #ff9999; /* Light red */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="result-container {{ $status === 'You are Approved' ? 'approved' : 'not-approved' }}">
                {{ $status }}
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap JS and jQuery scripts (required for Bootstrap components) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
