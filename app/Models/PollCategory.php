<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollCategory extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the color associated with the category.
     */
    public function color()
    {
        switch ($this->id) {
            case 1:
                return 'green';
                break;
            case 2:
                return 'blue';
                break;
            case 3:
                return 'yellow';
                break;
            case 4:
                return 'teal';
                break;
            case 5:
                return 'red';
                break;
            case 6:
                return 'pink';
                break;
            case 7:
                return 'orange';
                break;
            case 8:
                return 'purple';
                break;
            default:
                return 'green';
                break;
        }
    }
}
