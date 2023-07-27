<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Ticket;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function eventsMethod(Request $request)
    {
        $data = Post::latest()->get();

        return view('web.events', compact('data'));
    }

    public function show_events($id)
    {
        $post = Post::findOrFail($id);

        $zones = DB::table('zones')->where('post_id',$post->id)->get();

        return view('web.show_events')->with([
           'post'  => $post,
           'zones' => $zones
        ]);
    }
    public function store(Request $request)
    {

        $zone        = DB::table('zones')->where('id',$request->zone)->first();
        $price       = $zone->price;
        $total_price = $price * $request->people;
        $userId = Auth::id(); // Fetch the authenticated user's ID

        $ticket_code = mt_rand(1000000000, 9999999999);

        $ticket = new Ticket();
        $ticket->post_id = $request->input('post_id');
        $ticket->zone_id = $request->input('zone');
        $ticket->full_name = $request->input('full_name');
        $ticket->email = $request->input('email');
        $ticket->number = $request->input('number');
        $ticket->age = $request->input('age');
        $ticket->people = $request->input('people');
        $ticket->zone = $zone->name;
        $ticket->zone_price = $price;
        $ticket->ticket_code = $ticket_code;
        $ticket->total_price = $total_price;
        $ticket->user_id = $userId; // Assign the user ID to the "user_id" column
        $ticket->save();


        return redirect()->back()->with('success', 'Your Reservation sent successfully. Please waiting for approval!');
    }

    public function ticketCodeExists($number){
        return Ticket::whereTicketCode($number)->exists();
    }

    public function ticket()
    {

        $userId = Auth::id();

        // Retrieve the posts created by the authenticated user along with their reservations
        $tickets = Ticket::where('user_id', $userId)->latest()->get();


        return view('web.user_tickets')->with([
            'tickets' => $tickets
        ]);
    }

    public function show_ticket($id)
    {
        $ticket = Ticket::findOrFail($id);

        $post = Post::findOrFail($ticket->post_id);


        return view('web.show_ticket')->with([
            'ticket' => $ticket,
            'post'   => $post,

        ]);
    }
}
