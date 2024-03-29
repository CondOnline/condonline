<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    use FileTrait;

    public function index()
    {
        $trackingsNews = Auth()->user()->unreadNotifications()
                                        ->whereType('App\Notifications\NewOrder')
                                        ->get()
                                        ->pluck('data.tracking')
                                        ->toArray();

        $trackingsDelivered = Auth()->user()->unreadNotifications()
                                        ->whereType('App\Notifications\DeliveredOrder')
                                        ->get()
                                        ->pluck('data.tracking')
                                        ->toArray();

        $orders = Auth()->user()->orders()->latest('updated_at')->get();

        return view('user.orders.index', [
            'orders' => $orders,
            'trackingsNews' => $trackingsNews,
            'trackingsDelivered' => $trackingsDelivered
        ]);
    }

    public function show(Order $order)
    {
        if(Auth()->user() != $order->user)
            return redirect()->back();

        Auth()->user()->unreadNotifications()->where('data->tracking', $order->tracking)->get()->markAsRead();

        return view('user.orders.show', [
            'order' => $order
        ]);
    }

    public function image(Order $order, $image)
    {
        if (Auth()->user() != $order->user)
            return redirect()->back();

        $image = ($image == 'signature') ? $order->image_signature : $order->image;

        $response = $this->getFile($image, 'order');

        return $response;
    }
}
