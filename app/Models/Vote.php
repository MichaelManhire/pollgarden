<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the vote.
     */
    public function caster()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the option that owns the vote.
     */
    public function option()
    {
        return $this->belongsTo('App\Models\PollOption', 'option_id');
    }

    /**
     * Get the poll that owns the vote.
     */
    public function poll()
    {
        return $this->option->poll;
    }
}
