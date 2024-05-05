@extends('layouts.posts.app')
@section('content')
<section class="w-3/4 flex flex-col items-center px-3 mx-auto">

    <div class=" p-6 container text-center">
        
    </div>
    
    <article class="flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75">
            <img class="w-full" src="/images/{{$fixture->image_cover}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            
            <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$fixture->title}}</a>
            <p href="#" class="text-sm pb-3">
                By <a href="#" class="font-semibold hover:text-gray-800">{{$fixture->user->name}}</a>, Published on {{ \Carbon\Carbon::parse($fixture->updated_at)->isoFormat('MMMM Do, YYYY') }}  
            </p>
            <a href="#" class="pb-6">{{$fixture->description}}</a>
            @if (Auth::user() && Auth::user()->id == $fixture->user_id)
            <div class="flex space-x-4">
                <!-- Edit Button -->
                <a  href="/fixtures/{{$fixture->slug}}/edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            
                <!-- Delete Button -->
                <form action="/fixtures/{{$fixture->slug}}" method="post" class="inline-block"> @csrf @method('delete')
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <i class="fas fa-trash-alt mr-2"></i> Delete
                    </button>
                </form>
            </div>
            @endif
           
            
        </div>
    </article>

    

    

    

    

     

 </section>

@endsection




