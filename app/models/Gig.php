<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 02/05/14
 * Time: 22:12
 */


// Won't use Eloquent just yet
class Gig extends Eloquent {

    protected $fillable = [
      "date", "time", "location", "about"
    ];

} 