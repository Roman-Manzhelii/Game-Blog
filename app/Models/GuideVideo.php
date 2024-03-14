<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideVideo extends Model
{
    use HasFactory;

    protected $fillable = ['guide_id', 'path', 'external_url'];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
