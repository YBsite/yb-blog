@extends('layouts.posts.app')
@section('content')
<div class="container mx-auto flex flex-wrap py-6">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        <p class="text-xl font-semibold pb-5">All Posts</p>
            <article class="flex flex-col shadow my-4">
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 p-2">Title</th>
                            <th class="border border-gray-300 p-2">Category</th>
                            <th class="border border-gray-300 p-2">Author</th>
                            <th class="border border-gray-300 p-2">Date</th>
                            <th class="border border-gray-300 p-2">Description</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $item)
                        <tr>
                            <td class="border border-gray-300 p-2">
                                <a href="#" class="text-lg font-bold hover:text-gray-700">{{$item->title}}</a>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <a href="#" class="text-sm font-bold uppercase">{{$item->category->name}}</a>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <a href="#" class="text-sm font-semibold hover:text-gray-800">{{$item->user->name}}</a>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <p class="text-sm">{{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('MMMM Do, YYYY') }}</p>
                            </td>
                            <td class="border border-gray-300 p-2">
                                <p class="text-sm">{{ strlen($item->description) > 10 ? substr($item->description, 0, 120) . '...' : $item->description }}</p>
                            </td>
                            <td class="border border-gray-300 p-2">
                                
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <!-- Add/Edit/Delete buttons for authorized user -->
                                <div class="flex">
                                    <!-- Edit Button -->
                                    <a href="/blog/{{$item->slug}}/edit" class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="/blog/{{$item->slug}}" method="post" class="inline-block">@csrf @method('delete')
                                        <button class="text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            
                            </td>
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-4">
                    {{ $posts->links() }}
                </div>
                
            </article>
       
    
    </section>
    

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
        <p class="text-left text-xl font-semibold pb-5">All Users</p>

        <table class="w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">User</th>
                    <th class="border border-gray-300 px-4 py-2">Role</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Display user details like name or username -->
                            {{ $user->name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Display user role -->
                            blogger
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <!-- Actions -->
                            <!-- Replace the anchor tags with appropriate actions -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                            
                                <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" title="Delete User">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border border-gray-300 px-4 py-2">No users available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="m-4">
            {{ $users->links() }}
        </div>
        
        
       

       <div class="w-full bg-white shadow flex flex-col my-4 p-6">
    <p class="text-xl font-semibold pb-5">Add New User</p>
    <form action="{{ route('user.add') }}" method="post" class="grid grid-cols-2 gap-3">
        @csrf <!-- Add CSRF token for Laravel forms -->

        <div class="flex flex-col">
            <label for="name" class="pb-1">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="flex flex-col">
            <label for="email" class="pb-1">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="flex flex-col">
            <label for="password" class="pb-1">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="col-span-2 flex justify-end">
            <button type="submit" class="bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 px-4 py-2 mt-4">
                Add New User
            </button>
        </div>
    </form>
    
</div>


    </aside>

</div>



<script>
    function getCarouselData() {
        return {
            currentIndex: 0,
            images: [
                'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                'https://source.unsplash.com/collection/1346951/800x800?sig=6',
                'https://source.unsplash.com/collection/1346951/800x800?sig=7',
                'https://source.unsplash.com/collection/1346951/800x800?sig=8',
                'https://source.unsplash.com/collection/1346951/800x800?sig=9',
            ],
            increment() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
            },
            decrement() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex - 1;
            },
        }
    }

    
</script>

@endsection