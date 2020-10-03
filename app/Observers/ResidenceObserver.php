<?php

namespace App\Observers;

use App\Models\Residence;

class ResidenceObserver
{
    public function deleting(Residence $residence)
    {
        $residence->users()->detach();
    }
}
