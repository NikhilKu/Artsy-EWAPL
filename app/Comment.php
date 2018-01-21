<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Comment
 * 
 * Represents a comment on a research from a user.
 */
class Comment extends Model
{
    protected $table = 'comment';
    
    function profile() {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }
}
