<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Residence;
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
        $users = User::whereNotIn('id', [1])->count();
        $residences = Residence::count();
        $orders = Order::whereNull('received')->count();


        return view('admin.dashboard', [
            'users' => $users,
            'residences' => $residences,
            'orders' => $orders
        ]);
    }
}
