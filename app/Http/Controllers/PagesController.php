<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Interview;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index() {
        $posts = Post::latest()->take(1)->get();
        $interviews = Interview::latest()->take(9)->get();
        $fixtures = Fixture::latest()->get();
    
        return view('layouts.guest.home', compact('posts', 'interviews','fixtures'));
    }
    public function NewsContent(){
        $posts = Post::where('category_id', 1)->latest()->paginate(6);
        return view('layouts.guest.news', ['posts' => $posts]);
    }

    public function AtlasLionsContent(){
        $posts = Post::where('category_id', 2)->latest()->paginate(6);
        return view('layouts.guest.atlaslions', ['posts' => $posts]);
    }

    public function AtlasLionssesContent(){
        $posts = Post::where('category_id', 3)->latest()->paginate(6);
        return view('layouts.guest.atlaslionsses', ['posts' => $posts]);
    }

    public function YouthContent(){
        $posts = Post::where('category_id', 4)->latest()->paginate(6);
        return view('layouts.guest.youth', ['posts' => $posts]);
    }

    public function FutsalContent(){
        $posts = Post::where('category_id', 5)->latest()->paginate(6);
        return view('layouts.guest.futsal', ['posts' => $posts]);
    }
    public function showLogin(){
        return view('layouts.guest.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function About(){
        return view('layouts.guest.about');
    }
}
