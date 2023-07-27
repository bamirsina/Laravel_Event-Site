<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class PostController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return Application|Factory|View|void
     */

    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = Post::latest()->paginate(5);

        $userId = Auth::id();

        $data = Post::where('user_id', $userId)->latest()->paginate(5);

        return view('posts.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'event_name'    => 'required',
            'the_guests'    => 'required',
            'club_name'     => 'required',
            'club_location' => 'required',
            'zones.*.name'  => 'required|unique:zones,name',
            'zones.*.price' => 'required|numeric|min:0',
            'datetime'      => 'required',
            'logo_path'     => 'required|image|max:2048'
        ]);

        if ($request->hasFile('logo_path')) {
            $imageName = time() . '.' . $request->file('logo_path')->getClientOriginalExtension();
            $request->file('logo_path')->move(public_path('logos'), $imageName);
            $path = 'logos/' . $imageName;
        }

        $new_post =  Post::create([
            'user_id'       => \auth()->id(),
            'logo_path'     => $path ?  : "",
            'event_name'    => $request->event_name ?  : "",
            'the_guests'    => $request->the_guests ?  : "",
            'club_name'     => $request->club_name ?  : "",
            'club_location' => $request->club_location ?  : "",
            'datetime'      => Carbon::parse($request->datetime)->toDateTimeString() ?  : "",
            'name'          => '--' ,
            'price'         => 00,
        ]);


        foreach ($request->zones as $zoneData) {

            DB::table("zones")->insert([
               'name'    => $zoneData['name'],
               'price'   => $zoneData['price'],
               'post_id' => $new_post->id,
            ]);
        }



        return redirect()->route('posts.index')->with('success', 'Posts created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
        // Check if the authenticated user is the creator of the post
        if ($post->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }
        // Additional logic here
        // ...
        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'the_guests' => 'required',
            'club_name' => 'required',
            'club_location' => 'required',
//            'zone' => 'required',
            'datetime' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        // Check if the authenticated user is the creator of the post
        if ($post->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this post.');
        }

        $imageName = time().'.'.$request->logo->getClientOriginalExtension();
        $request->logo->move(public_path('/logos'), $imageName);
        $path = 'logos/'.$imageName;

            $post->update($request->all());

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param $post
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        if ($post->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        } else {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }
    }
}


