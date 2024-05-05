<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FixturesController extends Controller
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
        return view('layouts.fixtures.index')->with('fixtures',Fixture::latest()->paginate(6));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.fixtures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'equipe'=>'required',
            'image_cover'=>'required|mimes:jpg,png,jped|max:5048',
            'team_logo'=>'required|mimes:jpg,png,jped|max:5048',
            'team_name'=>'required',
            'match_date'=>'required',
            'match_time'=>'required'
        ]);

        
    

        $slug = Str::slug($request->title,'-');
        $newImageName = uniqid().'-'.$slug.'.'.$request->image_cover->extension();
        $newImageName2 = uniqid().'-logo-'.$slug.'.'.$request->team_logo->extension();
        $request->image_cover->move(public_path('images'),$newImageName);
        $request->team_logo->move(public_path('images'),$newImageName2);
        
        Fixture::create([
            'user_id'=>auth()->user()->id,
            'title' =>$request->input('title'),
            'equipe' =>$request->input('equipe'),
            'slug'=>$slug,
            'image_cover'=>$newImageName,
            'team_logo'=>$newImageName2,
            'team_name'=>$request->input('team_name'),
            'match_date'=>$request->input('match_date'),
            'match_time'=>$request->input('match_time')

        ]);
        return redirect('/fixtures'); 
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        return view('layouts.fixtures.show')
        ->with('fixture',Fixture::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    
     public function edit($slug)
     {
         return view('layouts.fixtures.edit')
         ->with('fixture',Fixture::where('slug',$slug)->first());
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $slug)
     {
         $request->validate([
             'title'=>'required',
             'equipe'=>'required',
             'image_cover'=>'required|mimes:jpg,png,jped|max:5048',
             'team_logo'=>'required|mimes:jpg,png,jped|max:5048',
             'team_name'=>'required',
             'match_date'=>'required',
             'match_time'=>'required'
         ]);
 
         
     
 
         $slug = Str::slug($request->title,'-');
         $newImageName = uniqid().'-'.$slug.'.'.$request->image_cover->extension();
         $newImageName2 = uniqid().'-logo-'.$slug.'.'.$request->team_logo->extension();
         $request->image_cover->move(public_path('images'),$newImageName);
         $request->team_logo->move(public_path('images'),$newImageName2);
         
         Fixture::where('slug',$slug)->update([
             'user_id'=>auth()->user()->id,
             'title' =>$request->input('title'),
             'equipe' =>$request->input('equipe'),
             'slug'=>$slug,
             'image_cover'=>$newImageName,
             'team_logo'=>$newImageName2,
             'team_name'=>$request->input('team_name'),
             'match_date'=>$request->input('match_date'),
             'match_time'=>$request->input('match_time')
         ]);
         return redirect('/fixtures/' .$slug)->with('message','updated succefuly');
     }
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        Fixture::where('slug',$slug)->delete();
        return redirect('/fixtures/')->with('message','the post has deleted');  
    }
}
