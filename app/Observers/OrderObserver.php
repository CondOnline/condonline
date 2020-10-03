<?php

namespace App\Observers;

use App\Jobs\DeliveredOrderJob;
use App\Jobs\NewOrderJob;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        NewOrderJob::dispatch($order);
    }

    public function updating(Order $order)
    {
        if ($order->isDirty('delivered_at') && !$order->getOriginal('delivered_at'))
            DeliveredOrderJob::dispatch($order);
    }
}
