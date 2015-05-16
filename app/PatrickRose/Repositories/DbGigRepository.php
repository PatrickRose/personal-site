<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 16/05/15
 * Time: 19:33
 */

namespace PatrickRose\Repositories;


use Carbon\Carbon;
use Gig;

class DbGigRepository implements GigRepositoryInterface {

    public function all()
    {
        return Gig::where('date', '>', Carbon::now())
            ->orderBy('date')
            ->paginate(30);
    }

    public function create(array $input)
    {
        $gig = new Gig($input);
        $gig->save();

        return $gig;
    }
}