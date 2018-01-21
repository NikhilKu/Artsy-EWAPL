<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Like
 * 
 * Represents a like.
 */
class Like extends Model {

    public function up() {
        Schema::create('likes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

}
