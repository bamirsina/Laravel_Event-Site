<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Ticket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/show_tisket.css') }}">
</head>
<body>
<div class="container">
    <h1 class="ticket-heading">This is your ticket</h1>
    <div class="ticket">
        <!-- Your ticket content -->
        <!-- Add your ticket details here -->
    </div>
    <a href="{{ route('web.events') }}" class="btn-back">Back</a>
</div>

</body>
</html>
<div class="ticket">
    <div class="left">
        <div class="image card__background"
             style="background-image: url('{{ asset($post->logo_path) }}');
        width: 250px; height: 250px; background-size: 390px; opacity: 0.85">
        <p class="admit-one">
                <span>{{ $post->club_name }}</span>
                <span>{{ $post->club_name }}</span>
                <span>{{ $post->club_name }}</span>
            </p>
            <div class="ticket-number">
                <p>
                    #20030220
                </p>
            </div>
        </div>
        <div class="ticket-info">
            <p class="date">

                <span class="june-29">{{ $post->datetime }}</span>
                <span>2023</span>
            </p>
            <div class="show-name">
                <h1>{{ $post->the_guests }}</h1>
            </div>
            <div class="time">
                <p>Started At <span>@</span> {{ $post->datetime }}</p>
            </div>
            <p class="location"><span>{{ $ticket->full_name }}</span>
                <span class="separator"><i class="far fa-smile"></i></span><span>{{ $ticket->number}}</span>
            </p>
        </div>
    </div>
    <div class="right">
        <p class="admit-one">
            <span>{{ $post->club_name }}</span>
            <span>{{ $post->club_name }}</span>
            <span>{{ $post->club_name }}</span>
        </p>
        <div class="right-info-container">
            <div class="show-name">
                <h1>{{ $post->event_name }}</h1>
            </div>
            <div class="time">
                <p>STARTED AT</p>
                <p>{{ $post->datetime }}</p>
            </div>
            <div class="barcode">
                <img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
            </div>
            <p class="ticket-number">
                {{ $ticket->ticket_code }}
            </p>
        </div>
    </div>
</div>
