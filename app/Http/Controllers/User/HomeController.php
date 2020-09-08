<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Auth()->user()->orders()->whereNull('received')->count();

        return view('dweller.dashboard',[
            'orders' => $orders
        ]);
    }

    public function clearNotifications()
    {
        Auth()->user()->unreadNotifications->markAsRead();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Notificações apagadas com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }
}
