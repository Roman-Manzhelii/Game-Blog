<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;
use App\Models\Game;
use App\Models\GuideImage;
use App\Models\GuideVideo;

class GuidesController extends Controller
{

    public function index()
    {
        $guides = Guide::paginate(10); // Adjust according to your needs
        return view('guides.index', compact('guides'));
    }

    public function create()
    {
        $games = Game::pluck('name', 'id'); // Fetch games to select from
        return view('guides.create', compact('games'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'game_id' => 'required|exists:games,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'videos' => 'nullable|array',
            'videos.*' => 'file|mimes:mp4,mov|max:100000',
        ]);
    
        // Exclude 'images' and 'videos' from mass assignment
        $guideData = Arr::except($validatedData, ['images', 'videos']);
        $guideData['user_id'] = auth()->id();
        $guide = Guide::create($guideData);
    
        // Handle Image Uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImageName = uniqid() . '.' . $image->extension();
                $image->move(public_path('images'), $newImageName); // Move file to public/images
                GuideImage::create([
                    'guide_id' => $guide->id,
                    'path' => $newImageName, // Store path in DB
                ]);
            }
        }
    
        // Handle Video Uploads
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $newVideoName = uniqid() . '.' . $video->extension();
                $video->move(public_path('videos'), $newVideoName); // Move file to public/videos
                GuideVideo::create([
                    'guide_id' => $guide->id,
                    'path' => $newVideoName, // Store path in DB
                ]);
            }
        }
    
        return redirect()->route('guides.index')->with('success', 'Guide created successfully.');
    }

    public function edit($id)
    {
        $guide = Guide::findOrFail($id);
        $games = Game::pluck('name', 'id'); // Fetch games for the dropdown
        return view('guides.edit', compact('guide', 'games'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'game_id' => 'required|exists:games,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'videos' => 'nullable|array',
            'videos.*' => 'file|mimes:mp4,mov|max:100000',
        ]);
    
        $guide = Guide::findOrFail($id);
    
        // Перевіряємо, чи були завантажені нові зображення або відео
        if ($request->hasFile('images') ) {
            // Видаляємо старі зображення та відео
            foreach ($guide->images as $image) {
                File::delete(public_path('images/' . $image->path));
                $image->delete(); // Видаляємо запис із бази даних
            }
        }
            if ($request->hasFile('videos')) {
            foreach ($guide->videos as $video) {
                File::delete(public_path('videos/' . $video->path));
                $video->delete(); // Видаляємо запис із бази даних
            }
        }
    
        $guide->update(Arr::except($validatedData, ['images', 'videos']));
    
        // Обробка завантаження нових зображень
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImageName = uniqid() . '.' . $image->extension();
                $image->move(public_path('images'), $newImageName);
                GuideImage::create([
                    'guide_id' => $guide->id,
                    'path' => $newImageName,
                ]);
            }
        }
    
        // Обробка завантаження нових відео
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $newVideoName = uniqid() . '.' . $video->extension();
                $video->move(public_path('videos'), $newVideoName);
                GuideVideo::create([
                    'guide_id' => $guide->id,
                    'path' => $newVideoName,
                ]);
            }
        }
    
        return redirect()->route('guides.index')->with('success', 'Guide updated successfully.');
    }
    public function show($id)
    {
        $guide = Guide::findOrFail($id);
        $images = $guide->images; 
        $videos = $guide->videos; 
        return view('guides.show', compact('guide', 'images', 'videos'));
    }

    public function destroy($id)
    {
        $guide = Guide::findOrFail($id);
    
        // Видаляємо зображення та відео
        foreach ($guide->images as $image) {
            File::delete(public_path('images/' . $image->path));
            $image->delete();
        }
        foreach ($guide->videos as $video) {
            File::delete(public_path('videos/' . $video->path));
            $video->delete();
        }
    
        $guide->delete();
    
        return redirect()->route('guides.index')->with('success', 'Guide deleted successfully.');
    }

}
