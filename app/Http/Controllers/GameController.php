<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game; 

class GameController extends Controller
{

    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }


    public function create()
    {
        return view('games.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string',
            'platform' => 'required|array',
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

        $game = new Game;
        $game->name = $request->name;
        $game->description = $request->description;
        $game->developer = $request->developer;
        $game->release_date = $request->release_date;
        $game->genre = $request->genre;
        $game->platform = json_encode($request->input('platform'));
        $game->image_path = $newImageName;
        $game->video_path = $newVideoName;
        $game->save();
    

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }


    public function show($id)
    {
        $game = Game::findOrFail($id);
        return view('games.show', compact('game'));
    }


    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string',
            'platform' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'video' => 'nullable|file|mimes:mp4,mov|max:100000',
        ]);
    
        $game = Game::findOrFail($id);
        
        if ($request->hasFile('image')) {
            if ($game->image_path && file_exists(public_path('images/' . $game->image_path))) {
                unlink(public_path('images/' . $game->image_path));
            }
            $newImageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $game->image_path = $newImageName;
        }

        if ($request->hasFile('video')) {
            if ($game->video_path && file_exists(public_path('videos/' . $game->video_path))) {
                unlink(public_path('videos/' . $game->video_path));
            }

            $newVideoName = uniqid() . '.' . $request->video->extension();
            $request->video->move(public_path('videos'), $newVideoName);
            $game->video_path = $newVideoName;
        }

        $game->name = $request->name;
        $game->description = $request->description;
        $game->developer = $request->developer;
        $game->release_date = $request->release_date;
        $game->genre = $request->genre;
        $game->platform = json_encode($request->input('platform'));
        $game->save();

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }


    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();
        
        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
