<?php namespace PatrickRose\Repositories;
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 02/05/14
 * Time: 22:06
 */

use Gig;

class StaticGigRepository implements GigRepositoryInterface {

    protected $gigs;

    public function __construct()
    {
        $gigs = [];

        $gigs[] = new Gig([
            "date" => "6th June",
            "time" => "7:30pm",
            "location" => "Redhouse",
            "about" => "Slot at Thank Folk Its Friday"
        ]);
        $gigs[] = new Gig([
            "date" => "5th July",
            "time" => "TBC",
            "location" => "Wincobank Hill",
            "about" => "Tour De France community event"
        ]);
        $gigs[] = new Gig([
            "date" => "12th July",
            "time" => "PRIVATE",
            "location" => "Private Party",
            "about" => "Calling with Whiskey for Six"
        ]);
        $gigs[] = new Gig([
            "date" => "19th July",
            "time" => "PRIVATE",
            "location" => "Private Party",
            "about" => "Calling gig at wedding party"
        ]);

        $this->gigs = $gigs;
    }

    public function all()
    {
        return $this->gigs;
    }
}
