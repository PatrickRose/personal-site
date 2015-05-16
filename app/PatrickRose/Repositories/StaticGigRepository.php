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
            "date" => "3rd September",
            "time" => "8:00pm (Doors at 7:30)",
            "location" => "Shakespeare's",
            "about" => "Support act for the <a href='https://www.facebook.com/theteacupsquartet'>Teacups</a>. <a href='http://www.wegottickets.com/event/276158'>Tickets £8/£7</a>"
        ]);

        $this->gigs = $gigs;
    }

    public function all()
    {
        return $this->gigs;
    }

    public function create(array $input)
    {
        $gig = new Gig($input);
        $this->gigs[] = $gig;

        return $gig;
    }
}
