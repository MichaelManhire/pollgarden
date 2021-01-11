<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['comments', 'votes'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the poll.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the category that owns the poll.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\PollCategory', 'category_id');
    }

    /**
     * Get the comments for the poll.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get the image associated with the poll or its author.
     */
    public function image()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return $this->author->profile_photo_url;
    }

    /**
     * Get the options for the poll.
     */
    public function options()
    {
        return $this->hasMany('App\Models\PollOption');
    }

    /**
     * Get the parent comments for the poll.
     */
    public function parentComments()
    {
        return $this->comments->whereNull('parent_comment_id');
    }

    /**
     * Get the votes for the poll.
     */
    public function votes()
    {
        return $this->hasManyThrough('App\Models\Vote', 'App\Models\PollOption', 'poll_id', 'option_id');
    }
}
