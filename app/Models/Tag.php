<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'slug'];
    // Relation Many To Many (MOTIVATION)
    public function motivations()
    {
        return $this->belongsToMany('App\Models\Motivation');
    }
}
