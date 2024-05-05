@extends('layouts.posts.app')
@section('content')
<div class="container mx-auto flex flex-wrap py-6">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @forelse ($posts as $item)
            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img class="w-full" src="/images/{{$item->image_path}}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$item->category->name}}</a>
                    <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$item->title}}</a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{$item->user->name}}</a>,
                        Published on {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('MMMM Do, YYYY') }}  
                    </p>
                    <a href="#" class="pb-6">{{ strlen($item->description) > 10 ? substr($item->description, 0, 120) . '...' : $item->description }}</a>
                    <a href="/blog/{{$item->slug}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        @empty
            <p>No posts available.</p>
        @endforelse
    
        <!-- Pagination -->
        <div class="flex justify-center items-center mt-8">
            <a href="/blog" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Show More
            </a>
        </div>
    
    </section>
    

    <!-- Sidebar Section -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

        @forelse ($fixtures as $item)
       <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <div class="px-4 py-2 bg-gray-100">
            <h2 class="text-gray-800 text-lg font-bold">
              {{$item->equipe}} - <span class='text-sm text-gray-800 font-bold'>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->match_date)->format('d M Y') }}

            </span>
            </h2>
          </div>
          <div class="flex justify-between items-center px-4 py-3 bg-gray-200">
            <div class="flex items-center">
              <img
                class="h-8 w-8 mr-2 object-contain"
                src="https://upload.wikimedia.org/wikipedia/en/thumb/d/d0/Royal_Moroccan_Football_Federation_logo.svg/1200px-Royal_Moroccan_Football_Federation_logo.svg.png"
                alt='logo'
              />
              <h2 class="text-gray-800 text-md font-bold">Morocco</h2>
            </div>
            <div class="text-gray-800 text-sm font-bold">
                {{ \Carbon\Carbon::createFromFormat('H:i:s', $item->match_time)->format('H:i') }}
            </div>
            <div class="flex items-center">
              <h2 class="text-gray-800 text-md font-bold">{{$item->team_name}}</h2>
              <img
                class="h-8 w-8 ml-2 object-contain"
                src="images/{{$item->team_logo}}"
                alt={`${team2} Logo`}
              />
            </div>
        
    </div>
    @empty
    <p class="pt-5">No fixtures available.</p>
@endforelse
        <a href="/fixtures" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
            see more
        </a>
       

        <div class="w-full bg-white shadow flex flex-col my-4 p-6">
            <p class="text-xl font-semibold pb-5">Interviews</p>
            <div class="grid grid-cols-3 gap-3">
                @forelse ($interviews as $item)
                <div class="relative group">
                    <img class="img-normal w-full h-full object-cover" src="/images/{{$item->image}}" alt="Image" />
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <a href="/interviews/{{$item->slug}}">
                            <svg class="w-16 h-16 text-white fill-current" viewBox="0 0 20 20">
                                <!-- Your play icon -->
                                <path d="M14 10L6 6v8l8-4z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <p class="pt-5">No interviews available.</p>
                @endforelse   
            </div>
            <a href="/interviews" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                 see more interviews
            </a>
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