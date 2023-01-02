<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    public function Ads()
    {
        return $this->belongsToMany(Ad::class, 'ads_tags', 'tags_id', 'ads_id');
    }
}
