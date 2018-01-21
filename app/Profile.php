<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Profile
 * 
 * Represents the information about a user.
 */
class Profile extends Model {

    protected $table = "profile";
    protected $primaryKey = 'user_id';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function research() {
        return $this->hasMany('App\Research', 'user_id', 'user_id');
    }

    public function countresearch() {
        return $this->hasMany('App\Research', 'id', 'user_id');
    }

    public function comment() {
        return $this->hasMany('App\Comment');
    }

    public function school() {
        return $this->hasOne('App\School', 'id', 'school_id');
    }

    public function rank() {
        return $this->hasOne('App\roles', 'id', 'role');
    }

    public function favorite() {
        return $this->hasMany('App\Favorite', 'user_id', 'user_id');
    }

}
