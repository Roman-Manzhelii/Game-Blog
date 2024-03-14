<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Game;

class GuidesController extends Controller
{

    public function index()
    {
        $guides = Guide::paginate(10); // Або Guide::all(); для виведення всіх гайдів без пагінації
        return view('guides.index', compact('guides'));
    }

    public function create()
    {
        $games = Game::pluck('name', 'id'); 
        return view('guides.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'video' => 'nullable|file|mimes:mp4,mov|max:100000',
        ]);

        $newImageName = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $newVideoName = null;
        if ($request->hasFile('video')) {
            $newVideoName = uniqid() . '.' . $request->video->extension();
            $request->video->move(public_path('videos'), $newVideoName);
        }

        $guide = new Guide;
        $guide->title = $request->title;
        $guide->content = $request->content;
        $guide->game_id = $request->game_id; // Переконайтесь, що це поле є у формі і валідації
        $guide->user_id = auth()->id();
        $guide->path_image = $newImageName;
        $guide->path_video = $newVideoName;
        $guide->save();        

        return redirect()->route('guides.index')->with('success', 'Guide created successfully.');
    }

    // Display a specific guide
    public function show(Guide $guide)
    {
        return view('guides.show', compact('guide'));
    }
}
