<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'category_id',
        'tag_id',
        'advertiser_id',
        'start_date',
        'end_date',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Tags()
    {
        return $this->belongsToMany(Tag::class, 'ads_tags', 'ads_id', 'tags_id');
    }

    public function Advertiser()
    {
        return $this->belongsTo(User::class);
    }
}
