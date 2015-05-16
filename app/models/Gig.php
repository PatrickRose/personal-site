<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 02/05/14
 * Time: 22:12
 */


class Gig extends Eloquent {

    protected $fillable = [
        "date", "time", "location", "about", 'ticketlink', 'cost',
    ];

} 