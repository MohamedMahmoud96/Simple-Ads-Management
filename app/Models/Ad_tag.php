<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad_tag extends Model
{
    protected $table = 'ads_tags';

    protected $fillable = [
        'ads_id',
        'tags_id',
    ];
    use HasFactory;

    public function Ads()
    {
        return $this->belongsTo(Ad::class);
    }

    public function Tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
