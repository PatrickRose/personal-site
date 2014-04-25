<?php

class Tag extends \Eloquent {
	protected $fillable = ['tag'];

    public function posts() {
        return $this->belongsToMany("Blog");
    }
}