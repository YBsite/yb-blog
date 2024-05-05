@extends('layouts.posts.app')
@section('content')
<div class="m-auto text-center pt-14 pb-5">
    
</div>
<div class="w-full lg:w-2/4 bg-white shadow-md flex flex-col items-center px-3 mx-auto pb-5">
    <form action="/interviews" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="p-4 text-center">
        <h1 class="font-bold text-2xl">
          Add new interview
        </h1>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="title">
          Title
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Enter title" name="title">
        @error('title')
          <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="title">
          Video Src
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Enter title" name="video">
        @error('video_src')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="equipe">
          Description
        </label>
        <textarea class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10" id="equipe" type="text" placeholder="Enter a description" name="description"></textarea>
        @error('description')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
  
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">
          Post Image
        </label>
        <input type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="image">
        @error('image')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
  
  
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add Post</button>
    </form>
  </div>
@endsection
