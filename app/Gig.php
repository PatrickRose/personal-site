<?php

namespace PatrickRose;

use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    protected $fillable = [
	'date',
	'time',
	'location',
	'about',
	'cost',
	'ticketlink',
    ];
}
