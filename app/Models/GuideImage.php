<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideImage extends Model
{
    use HasFactory;
    
    protected $fillable = ['guide_id', 'path'];
    
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
