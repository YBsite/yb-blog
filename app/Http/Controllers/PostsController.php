<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Apply 'auth' middleware to create and edit methods
        $this->middleware('auth')->only(['create', 'edit']);
    }
    public function index()
    {
        
        return view('layouts.posts.index')->with('posts', Post::latest()->paginate(6));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,png,jped|max:5048',
            'category'=>'required'
        ]);
        $slug = Str::slug($request->title,'-');
        $newImageName = uniqid().'-'.$slug.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        
        Post::create([
            'title' =>$request->input('title'),
            'description' =>$request->input('description'),
            'slug'=>$slug,
            'image_path'=>$newImageName,
            'user_id'=>auth()->user()->id,
            'category_id'=>$request->input('category')
        ]);
        return redirect('/blog'); 
    }

    /**
     * Display the specified resource.
     */
    public function show($slug){
        return view('layouts.posts.show')
        ->with('post',Post::where('slug',$slug)->first());
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        return view('layouts.posts.edit')
        ->with('post',Post::where('slug',$slug)->first());
        ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,png,jped|max:5048',
            'category'=>'required'
        ]);
        $newImageName = uniqid().'-'.$slug.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
    
        Post::where('slug',$slug)->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'image_path'=>$newImageName,
            
            'user_id'=>auth()->user()->id,
        ]);
        return redirect('/blog/' .$slug)->with('message','updated succefuly');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        Post::where('slug',$slug)->delete();
        return redirect('/blog/')->with('message','the post has deleted');  
    }
}
