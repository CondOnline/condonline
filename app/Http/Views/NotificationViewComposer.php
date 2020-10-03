<?php

namespace App\Http\Views;


class NotificationViewComposer
{

    public function compose($view)
    {
        $notifyNewOrders = Auth()->user()->unreadNotifications()->whereType('App\Notifications\NewOrder')->count();
        $notifyDeliveredOrders = Auth()->user()->unreadNotifications()->whereType('App\Notifications\DeliveredOrder')->count();
        $NotifyDocuments = Auth()->user()->unreadNotifications()->whereType('App\Notifications\NewDocument')->count();
        $notifyCount = Auth()->user()->unreadNotifications()->count();

        return $view->with([
            'notifyNewOrders' => $notifyNewOrders,
            'notifyDeliveredOrders' => $notifyDeliveredOrders,
            'notifyDocuments' => $NotifyDocuments,
            'notifyCount' => $notifyCount
        ]);
    }

}
