<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the comment.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the likes for the comment.
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
     * Get the number of likes for the comment.
     */
    public function numberOfLikes()
    {
        return $this->likes->count();
    }

    /**
     * Get the poll that owns the comment.
     */
    public function poll()
    {
        return $this->belongsTo('App\Models\Poll');
    }

    /**
     * Get the replies for the comment.
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_comment_id');
    }
}
