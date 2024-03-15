@extends('layouts.app')

@section('content')
    <div class="background-image grid grid-cols-1 m-auto" style="background-image: url('/images/homegames.jpeg'); min-height: 75vh;">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    Discover the Latest in Gaming
                </h1>
                <a 
                    href="/games"
                    class="text-center bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 font-bold text-xl uppercase">
                    Explore Games
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-auto mx-auto py-15" style="background: linear-gradient(to right, #0f2027, #203a43, #2c5364);">
        <div class="flex justify-start pl-10"> 
            <img src="/images/reviews.jpeg" alt="Reviews" class="rounded-lg" style="width: 90%; max-width: 500px;">
        </div>

        <div class="m-auto sm:m-auto text-left w-4/5 block bg-gradient-to-r from-gray-600 to-gray-500 p-10 rounded-lg shadow-lg text-white">
            <h2 class="text-3xl font-extrabold mb-4">
                Spotlight on Gaming Excellence
            </h2>
            
            <p class="py-8">
                Enter a realm where every game is a journey, every character a friend, and every play session a memory cherished. This week, we spotlight a game that not only captivates but transforms the way we see and interact with the digital world. Unveil the artistry, the thrill, and the innovation in our latest review.
            </p>
        
            <a 
                href="/reviews"
                class="uppercase bg-blue-700 hover:bg-blue-800 text-white py-3 px-8 rounded-3xl transition-colors duration-200">
                Discover the Magic
            </a>
        </div>
    </div>    

    <div class="text-center p-15 bg-black text-white">
        <h2 class="text-2xl pb-5 text-l"> 
            Guides & Strategies
        </h2>

        <p class="py-8 text-gray-300">
            Elevate your gameplay with our expert guides and strategies. Whether you're a beginner or a seasoned pro, there's something for every level of play.
        </p>

        <a 
            href="/guides"
            class="uppercase bg-green-500 hover:bg-green-700 text-white py-3 px-8 rounded-3xl transition-colors duration-200">
            Explore Guides
        </a>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15">
        <div>
            <h3 class="text-3xl font-extrabold text-gray-600 mb-4">Behind the Scenes</h3>
            <p class="text-gray-500">
                Get a closer look at the game development process, from initial concept to final release. Discover the creativity and hard work that goes into bringing your favorite games to life.
            </p>
        </div>
        <div>
            <img src="/images/game-development-process.jpg" alt="Game Development Process" class="w-full rounded-lg shadow-md">
        </div>
    </div>
@endsection
