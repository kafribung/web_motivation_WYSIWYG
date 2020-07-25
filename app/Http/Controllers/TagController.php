<?php

namespace App\Http\Controllers;

use App\Models\Motivation;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $motivations = $tag->motivations()->paginate(6);

        return view('pages.motivation', compact('motivations'));
    }
    // public function show2($slug)
    // {
    //     $motivations = Motivation::with('tags')->whereHas('tags', function ($query) use ($slug) {
    //         $query->where('slug', $slug);
    //     })->paginate(6);

    //     return view('pages.motivation', compact('motivations'));
    // }
}
