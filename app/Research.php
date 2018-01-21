<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Research
 * 
 * Represents a research done by a researcher.
 */
class Research extends Model {

    protected $table = "research";

    public function profile() {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }
    
    public function research_has_category(){
        return $this->hasMany('App\Research_has_category', 'id', 'research_id');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment', 'research_id', 'id');
    }    
    public function category() {
        return $this->hasone('App\category', 'id' ,'cat_id');
    }
    
    public function favorite() {
        return $this->hasMany('App\Favorite','research_id', 'id');
    }
}
