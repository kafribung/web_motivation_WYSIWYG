<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = ['liketable_id, liketable_type'];

    public function liketable()
    {
        return $this->morphTo();
    }
}
