<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'source', 'description', 'url', 'sent_at', 'published_at'];
}
