@extends('layouts.posts.app')
@section('content')
<div class="m-auto text-center pt-14 pb-5">
    
</div>
<div class="w-full lg:w-2/4 bg-white shadow-md flex flex-col items-center px-3 mx-auto pb-5">
    <form action="/fixtures" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="p-4 text-center">
        <h1 class="font-bold text-2xl">
          Add new fixtures
        </h1>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="title">
          Title
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" placeholder="Enter title" name="title">
        @error('title')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="equipe">
          Equipe Name
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="equipe" type="text" placeholder="Enter equipe name" name="equipe">
        @error('equipe')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="team_name">
          Team Name
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" placeholder="Enter team name" name="team_name">
        @error('team_name')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="team_logo">
          Team Logo
        </label>
        <input type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="team_logo">
        @error('team_logo')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="cover_image">
          Cover Image
        </label>
        <input type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="image_cover">
        @error('image_cover')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="date">
          Date
        </label>
        <input type="date" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="match_date">
        @error('match_date')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="time">
          Time
        </label>
        <input type="time" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="match_time">
        @error('match_time')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
      @enderror
      </div>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Add Post</button>
    </form>
  </div>
@endsection
