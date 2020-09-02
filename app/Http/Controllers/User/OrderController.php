<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    use FileTrait;

    public function index()
    {
        $orders = Auth()->user()->orders;

        return view('dweller.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        if(Auth()->user() != $order->user)
            return redirect()->back();

        return view('dweller.orders.show', [
            'order' => $order
        ]);
    }

    public function image(Order $order, $image)
    {
        if (($order->image != $image && $order->image_signature != $image) || Auth()->user() != $order->user)
            return redirect()->back();

        $response = $this->getFile($image, 'order');

        return $response;
    }
}
