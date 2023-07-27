<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:home-userCount', ['only' => ['index','store']]);
        $this->middleware('auth');

        return view('posts.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $userId = Auth::id();


        // Count the number of reservations with status 'pending' for all posts
        $pendingReservationCount = Ticket::whereHas('post', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'pending')->count();

        // Retrieve the authenticated user's ID

        // Retrieve the count of posts associated with the authenticated user
        $postCount = Post::where('user_id', $userId)->count();

        // Retrieve the tickets related to the posts created by the authenticated user
        $ticketCount = Ticket::whereHas('post', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        return view('home', compact('userCount', 'postCount', 'ticketCount', 'pendingReservationCount'));
    }

}
