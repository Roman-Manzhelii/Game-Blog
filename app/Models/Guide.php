<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'game_id', 'user_id'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function images()
    {
        return $this->hasMany(GuideImage::class);
    }

    public function videos()
    {
        return $this->hasMany(GuideVideo::class);
    }
}