<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Motivation extends Model
{
    protected $touches  = ['user'];
    protected $fillable = ['title', 'description', 'slug', 'img'];

    // Relation Many to One (User)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Relation Many To Many (TAG)
    public function tags()
    {
        // return $this->belongsToMany(Tag::class);
        return $this->belongsToMany('App\Models\Tag');
    }

    // Mutator Arribute
    public function getTakeImgAttribute()
    {
        return  url('storage', $this->img);
    }

    // public function takeImg()
    // {
    //     return  url('storage/' . $this->img);
    // }

    // Author Lama
    public function author()
    {
        $user = Auth::check();
        if ($user) {
            return auth()->user()->id == $this->user_id;
        } else return false;
    }
}
