<?php

namespace PatrickRose\Repositories;

use Carbon\Carbon;
use PatrickRose\Gig;
use PatrickRose\Http\Requests\CreateGig;

class DbGigRepository implements GigRepositoryInterface
{

    public function all()
    {
        return Gig::where('date', '>', Carbon::now())
            ->orderBy('date')
            ->paginate(30);
    }

    public function create(CreateGig $input)
    {
        $gig = new Gig($input->except('_token'));
        $gig->save();

        return $gig;
    }
}
