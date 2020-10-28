<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the color associated with the option.
     */
    public function color()
    {
        $index = $this->index();

        switch ($index) {
            case 0:
                return '#a3d9a5';
                break;
            case 1:
                return '#cfbcf2';
                break;
            case 2:
                return '#f9da8b';
                break;
            case 3:
                return '#a4cafe';
                break;
            case 4:
                return '#f8b4d9';
                break;
            default:
                return '#a3d9a5';
                break;
        }
    }

    public function index()
    {
        $options = $this->poll->options;

        $index = $options->search(function ($option) {
            return $option->id === $this->id;
        });

        return $index;
    }

    /**
     * Get the percentage of votes cast for the option.
     */
    public function percentage($numberOfVotes, $totalVotes)
    {
        if ($totalVotes > 0) {
            return round($numberOfVotes / $totalVotes * 100) . '%';
        }

        return '0%';
    }

    /**
     * Get the poll that owns the option.
     */
    public function poll()
    {
        return $this->belongsTo('App\Models\Poll');
    }

    /**
     * Get the users who voted for this option.
     */
    public function voters()
    {
        $voters = collect($this->votes)->map(function ($vote) {
            return $vote->caster;
        })
        ->reject(function ($vote) {
            return empty($vote);
        });

        return $voters;
    }

    /**
     * Get the votes for the option.
     */
    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'option_id');
    }
}
