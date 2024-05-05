<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fixture;
use App\Models\Interview;
use App\Models\Post;
use App\Models\Role;

class AdminAuthController extends Controller
{

    public function create()
    {
        return view('layouts.admin.register');
    }

    public function store(Request $request)
    {
        // Validation rules can be adjusted according to your needs
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $adminRole = Role::where('name', 'admin')->first();

if ($adminRole) {
    $user->roles()->attach($adminRole);
    // Role 'admin' is now attached to the user
} else {
    // Handle if the role doesn't exist
}

        // You can customize the logic after registration (e.g., redirecting to a dashboard)
        // For instance:
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('/dashboard');
    }

    public function showLogin(){
        return view('layouts.admin.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function DashboardPage(){

       // Retrieve posts with pagination
        $posts = Post::latest()->paginate(2);

        $interviews = Interview::latest()->take(9)->get();
        $fixtures = Fixture::latest()->get();
        $users = User::whereNotIn('id', [14])->paginate(4);

        return view('layouts.admin.dashboard', compact('posts', 'interviews','fixtures','users'));
    }
    public function addUser(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Assign the "blogger" role to the user

        $bloggerRole = Role::where('name', 'blogger')->first();
if ($bloggerRole) {
    $user->roles()->attach($bloggerRole, ['user_type' => 'App\User']);
}

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'User created successfully as a blogger!');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        return redirect()->route('dashboard');
    }
}


