<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Favorite
 * 
 * Represents a favorited research.
 */
class Favorite extends Model
{
    protected $table = "favorite";

    public function research() {
        return $this->belongsTo('App\Research', 'research_id', 'id');
    }

    public function profile() {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }

}
