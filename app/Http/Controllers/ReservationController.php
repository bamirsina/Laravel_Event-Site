<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:reservations-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
    }
    public function index(Request $request)
    {
        $userId = Auth::id();

        Ticket::whereDate('created_at', '<=', now()->subDays(1))->delete();

        // Retrieve the reservations related to the posts created by the authenticated user
        $tickets = Ticket::whereHas('post', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->latest()->get();

        return view('reservations.index')->with([
            'tickets' => $tickets,
        ]);
    }
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        $post = Post::findOrFail($ticket->post_id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to view this reservation.');
        }

        return view('reservations.show')->with([
            'ticket' => $ticket,
            'post'   => $post,
        ]);
    }
    public function approveTicket(Request $request){

        $ticket = Ticket::findOrFail($request->ticket_id);

        $ticket->update([
           'is_approved' => $request->is_approved,
            'status' => $request->is_approved == 1 ? 'approved' :
                ( $request->is_approved == 2 ? 'not approved' : 'pending'),


        ]);
        return redirect()->route('reservations.index')
            ->with('success','Success');
    }

    public function showTickets()
    {
        return view('reservations.showtickets');
    }
    public function checkTicket(Request $request)
    {
        $ticketCode = $request->input('ticket_code');

        // Search the ticket in the database by ticket_id
        $ticket = Ticket::where('ticket_code', $ticketCode)->first();

        if ($ticket) {
            return view('reservations.TicketResult', ['status' => 'You are Approved']);
        } else {
            return view('reservations.TicketResult', ['status' => 'You are not approved']);
        }
    }
}
