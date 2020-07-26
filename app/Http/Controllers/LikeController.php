<?php

namespace App\Http\Controllers;

use App\Models\{Motivation, Like};
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($id, $type)
    {
        $type         = "App\Models\Motivation";
        $motivation   = Motivation::findOrFail($id);

        // Tidak Bisa Like diri sendiri
        if (auth()->user()->id == $motivation->user_id) {
            die('0');
        }

        // Tidak Bisa like berulang kali
        if ($motivation->isLike() == null) {
            Like::create([
                'liketable_id'   => $id,
                'liketable_type' => $type,
                'user_id'        => auth()->user()->id,
            ]);
        }
    }
}
