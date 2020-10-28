<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the comment that owns the like.
     */
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    /**
     * Get the user that owns the like.
     */
    public function liker()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
