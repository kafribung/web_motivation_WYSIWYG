<?php

namespace App\Http\Controllers;

use App\Models\{Motivation, Like};
use Illuminate\Http\Request;

class UnlikeController extends Controller
{
    public function store($id, $type)
    {
        $type         = "App\Models\Motivation";
        $motivation   = Motivation::findOrFail($id);

        // Unlike ketika datanya ada
        if ($motivation->isLike()) {
            Like::where('user_id', auth()->user()->id)
                ->where('liketable_id', $id)
                ->where('liketable_type', $type)->delete();
        }
    }
}
