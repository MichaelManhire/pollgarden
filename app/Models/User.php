<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes, CascadeSoftDeletes;
    use TwoFactorAuthenticatable;

    protected $cascadeDeletes = ['comments', 'polls', 'votes'];

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_online_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get the country that owns the user.
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $time = $this->created_at->second;
        $lastDigit = substr($time, -1);
        $isEven = substr($time, 0, 1) % 2 === 0;

        switch ($lastDigit) {
            case 0:
                if ($isEven) {
                    return url('images/avatars/apple-green.svg');
                }

                return url('images/avatars/apple-red.svg');
                break;
            case 1:
                if ($isEven) {
                    return url('images/avatars/bird-black.svg');
                }

                return url('images/avatars/bird-blue.svg');
                break;
            case 2:
                if ($isEven) {
                    return url('images/avatars/bug-black.svg');
                }

                return url('images/avatars/bug-red.svg');
                break;
            case 3:
                if ($isEven) {
                    return url('images/avatars/carrot-orange.svg');
                }

                return url('images/avatars/carrot-purple.svg');
                break;
            case 4:
                if ($isEven) {
                    return url('images/avatars/frog-green.svg');
                }

                return url('images/avatars/frog-orange.svg');
                break;
            case 5:
                if ($isEven) {
                    return url('images/avatars/lemon-green.svg');
                }

                return url('images/avatars/lemon-yellow.svg');
                break;
            case 6:
                if ($isEven) {
                    return url('images/avatars/pepper-green.svg');
                }

                return url('images/avatars/pepper-red.svg');
                break;
            case 7:
                if ($isEven) {
                    return url('images/avatars/sapling-green.svg');
                }

                return url('images/avatars/sapling-orange.svg');
                break;
            case 8:
                if ($isEven) {
                    return url('images/avatars/spider-black.svg');
                }

                return url('images/avatars/spider-brown.svg');
                break;
            case 9:
                if ($isEven) {
                    return url('images/avatars/tree-green.svg');
                }

                return url('images/avatars/tree-orange.svg');
                break;
            default:
                return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=57ae5b&background=e3f9e5';
                break;
        }
    }

    /**
     * Get the gender that owns the user.
     */
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    /**
     * Get whether the authenticated user has liked a particular comment.
     */
    public function hasLiked($comment)
    {
        return $comment->likes->contains('user_id', Auth::id());
    }

    /**
     * Get whether the user has any unread messages.
     */
    public function hasMessages()
    {
        return $this->receivedMessages->whereNull('read_at')->count();
    }

    /**
     * Get whether the user has any unread notifications.
     */
    public function hasNotifications()
    {
        return $this->unreadNotifications->count();
    }

    /**
     * Get whether the user has voted in a particular poll.
     */
    public function hasVotedIn($poll)
    {
        if ($this->cant('create', Vote::class)) {
            return false;
        }

        return $poll->votes->contains('user_id', $this->id);
    }

    public function isOnline()
    {
        if (is_null($this->last_online_at) || $this->last_online_at->diffInMinutes(now()) > 15) {
            return false;
        }

        return true;
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany('App\Models\Message', 'recipient_id');
    }

    /**
     * Get the polls for the user.
     */
    public function polls()
    {
        return $this->hasMany('App\Models\Poll');
    }

    /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }

    /**
     * Get the state that owns the user.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            // Get the name of the image path.
            $extension = $photo->extension();
            $path = 'profile-photos/' . $this['slug'] . '.' . $extension;
            $storagePath = storage_path('app/public/' . $path);

            // Crop and resize the image, then save it.
            $croppedImage = Image::make($photo);
            $croppedImage = $croppedImage->fit(200);
            $croppedImage->save($storagePath);

            // Set the image path on the user.
            $this->forceFill([
                'profile_photo_path' => $path,
            ])->save();
        });
    }

    /**
     * Get the user's vote for a particular poll.
     */
    public function voteIn($poll)
    {
        if (! $this->hasVotedIn($poll)) {
            return null;
        }

        return $poll->votes->where('user_id', $this->id)->first();
    }

    /**
     * Get the option that the user voted for in a particular poll.
     */
    public function votedOptionIn($poll)
    {
        $vote = $this->voteIn($poll);

        if (is_null($vote)) {
            return null;
        }

        return $vote->option;
    }

    /**
     * Get the votes for the user.
     */
    public function votes()
    {
        return $this->hasMany('App\Models\Vote');
    }
}
