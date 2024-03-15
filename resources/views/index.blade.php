@extends('layouts.app')

@section('content')
<div class="background-image grid grid-cols-1 m-auto" style="background-image: url('/images/homegames.jpeg'); background-size: cover; min-height: 75vh;">
    <div class="flex text-gray-100 pt-10">
        <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
            <h1 class="text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                Discover the Latest in Gaming
            </h1>
            <a href="/games" class="text-center bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 font-bold text-xl uppercase rounded-lg">
                Explore Games
            </a>
        </div>
    </div>
</div>


    <div class="sm:grid grid-cols-2 gap-15 w-full mx-auto py-15 px-5" style="background: linear-gradient(to right, #0f2027, #203a43, #2c5364);">
        <div class="flex justify-center sm:justify-start"> <!-- Adjusted for responsiveness -->
            <img src="/images/reviews.jpeg" alt="Reviews" class="rounded-lg w-full max-w-xs sm:max-w-sm md:max-w-md"> <!-- Responsive image sizing -->
        </div>
        <div class="flex flex-col justify-center items-center w-full px-4 sm:px-6 lg:px-10 bg-gradient-to-r from-gray-600 to-gray-500 rounded-lg shadow-lg text-white">
            <h2 class="text-3xl font-extrabold mb-4 text-center">
                Spotlight on Gaming Excellence
            </h2>
            <p class="py-5 text-center">
                Enter a realm where every game is a journey, every character a friend, and every play session a memory cherished. This week, we spotlight a game that not only captivates but transforms the way we see and interact with the digital world. Unveil the artistry, the thrill, and the innovation in our latest review.
            </p>
            <a href="/reviews" class="uppercase bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white mb-2 py-3 px-8 rounded-3xl transition-colors duration-200 text-sm">
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
    
        <div class="text-center">
            <a href="/guides" class="inline-block uppercase bg-green-500 hover:bg-green-700 text-white py-3 px-8 rounded-3xl transition-colors duration-200 whitespace-nowrap"> 
                Explore Guides
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 w-full mx-auto" style="background-color: #8B0000;">
        <div class="text-white flex flex-col justify-center px-12 py-8">
            <h3 class="text-4xl font-extrabold mb-6">In the Words of Legends</h3>
            <blockquote class="mb-4 italic">
                "It's dangerous to go alone! Take this." <span class="not-italic font-medium">- The Legend of Zelda</span>
            </blockquote>
            <blockquote class="mb-4 italic">
                "War. War never changes." <span class="not-italic font-medium">- Fallout</span>
            </blockquote>
            <blockquote class="mb-4 italic">
                "The cake is a lie." <span class="not-italic font-medium">- Portal</span>
            </blockquote>
            <blockquote class="mb-4 italic">
                "Stay awhile and listen." <span class="not-italic font-medium">- Diablo</span>
            </blockquote>
            <blockquote class="mb-4 italic">
                "I used to be an adventurer like you, then I took an arrow in the knee." - Skyrim
            </blockquote>
            <blockquote class="mb-4 italic">
                "No gods or kings. Only man." <span class="not-italic font-medium">- BioShock</span>
            </blockquote>
            <blockquote class="mb-6 italic">
                "Nothing is true, everything is permitted." <span class="not-italic font-medium">- Assassin's Creed</span>
            </blockquote>
            <a 
                href="https://www.gamedesigning.org/gaming/video-game-quotes/" 
                target="_blank" 
                rel="noopener noreferrer" 
                style="background-color: #CC7722;" 
                onmouseover="this.style.backgroundColor='#a56336'" 
                onmouseout="this.style.backgroundColor='#CC7722'"
                class="self-start text-white font-bold py-2 px-6 rounded-lg transition-colors duration-300">
                Explore More Quotes
            </a>            
        </div>
        <div class="flex justify-center items-center">
            <img src="/images/quotes.jpg" alt="Iconic Gaming Quotes" class="max-w-full h-auto max-h-400 object-contain">
        </div>
    </div>
    
    
    
@endsection
