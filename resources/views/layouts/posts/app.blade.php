
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvn_blog</title>
    <meta name="author" content="David Grzyb">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.png') }}" />
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&family=Roboto+Mono:wght@200;400;500;700&family=Rubik:wght@300;400;500;600;700&family=Varela+Round&display=swap');

        .font-family-karla {
            font-family: 'Rubik', sans-serif;  
        }




    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-gradient-to-r from-red-600 via-red-800 to-black  shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline ps-4">
                    <li><a class="hover:text-gray-200 hover:underline " href="/"> <img class="w-8 " src="{{ asset('images/logo.png') }}" alt="logo"></a></li>
                    <li><a class="hover:text-gray-200 hover:underline ps-4 " href="/about">About</a></li>
                </ul>
            </nav>

            @guest
            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a href="https://www.facebook.com/MVNENGLISH" target="_blank" class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/mvn.en/" target="_blank" class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com/MVN_EN?t=YBZ13gVrXDrZ5XVodBcvWg&s=09" target="_blank" class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                
            </div>
            @endguest
           @auth
           <div class="flex items-center text-lg no-underline text-white pr-6">
            <h3 class="text-white text-sm pe-4">
                {{ Auth::user()->name }}
                </h3>
               <form method="POST" action="{{ route('logout') }}">
                    @csrf <!-- Add CSRF token for Laravel form submission -->
            
                    <button type="submit" class="bg-red-500 hover:bg-red-700 py-2 text-white px-4 rounded flex items-center text-sm">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                    
               </form>
           </div>
        
        
                
    
           @endauth
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                Mvn Blog
            </a>
            <p class="text-lg text-gray-600">
                Home of moroccan football
            </p>

            @auth
            <div class="flex justify-center space-x-4 pt-8">
                <!-- Add New Post Button -->
                <a href="/blog/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs sm:text-lg">
                    Add New Post
                </a>
            
                <!-- Add New Interview Button -->
                <a href="/interviews/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-xs sm:text-lg">
                    Add New Interview
                </a>
            
                <!-- New Interview Button -->
                <a href="/fixtures/create" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-xs sm:text-lg" >
                    Add New Fixture
                </a>
            </div>
            
            @endauth
        </div>
        <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
            <div class="block sm:hidden">
                <a
                    href="#"
                    class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                    @click="open = !open"
                >
                    Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
                </a>
            </div>
            <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
                <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                    <a href="/news" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">News</a>
                    <a href="/atlaslions" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Atlas Lions</a>
                    <a href="/atlaslionsses" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Atlas Lionsses</a>
                    <a href="/futsal" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Futsal</a>
                    <a href="/youth" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Youth</a>
                    <a href="/interviews" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">interviews</a>
                </div>
            </div>
        </nav>
    </header>

    

    
    @yield('content')
    <body class="flex flex-col min-h-screen mt-6">
        <!-- Your content goes here -->
        
        <footer class="w-full bg-gradient-to-r from-red-600 via-red-800 to-black shadow mt-auto">
            <div class="w-full p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href='/' class="flex items-center mb-4 sm:mb-0">
                        <img src="{{ asset('images/logo.png') }}" class="h-8 mr-3" alt="mrv Logo" />
                    </a>
                    <nav class="flex-grow text-center sm:text-right">
                        <ul class="flex justify-center sm:justify-end space-x-6 text-gray-300 dark:text-gray-400 sm:hidden">
                            <!-- Add 'hidden' utility class for 'sm' breakpoint -->
                            <li class="hidden"><a href="/news" class="hover:underline">News</a></li>
                            <li class="hidden"><a href="/atlaslions" class="hover:underline">Atlas Lions</a></li>
                            <li class="hidden"><a href="/atlaslionsses" class="hover:underline">Atlas Lionsses</a></li>
                            <li class="hidden"><a href="/youth" class="hover:underline">Youth</a></li>
                            <li class="hidden"><a href="/futsal" class="hover:underline">Futsal</a></li>
                            <li class="hidden"><a href="/about" class="hover:underline">About</a></li>
                        </ul>
                        <!-- Visible for sm and larger screens -->
                        <ul class="flex justify-center sm:justify-end space-x-6 text-gray-300 dark:text-gray-400 hidden sm:flex">
                            <li><a href="/news" class="hover:underline">News</a></li>
                            <li><a href="/atlaslions" class="hover:underline">Atlas Lions</a></li>
                            <li><a href="/atlaslionsses" class="hover:underline">Atlas Lionsses</a></li>
                            <li><a href="/youth" class="hover:underline">Youth</a></li>
                            <li><a href="/futsal" class="hover:underline">Futsal</a></li>
                            <li><a href="/about" class="hover:underline">About</a></li>
                        </ul>
                    </nav>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span class="block text-sm text-gray-300 sm:text-center dark:text-gray-400">© 2023 <Link href="/" class="hover:underline">mvn_blog™</Link>. All Rights Reserved.</span>
            </div>
        </footer>
        
        
      
    

    

</body>
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
</html>