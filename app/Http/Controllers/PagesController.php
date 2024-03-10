<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function reviews()
    {
        return view('reviews.index');
    }

    public function guides()
{
    return view('guides.index');
}


    public function news()
    {
        return view('news.index');
    }
}