<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = \App\User::count();
        $residences = \App\Residence::count();
        $orders = \App\Order::whereNull('received')->count();

        return view('admin.dashboard', [
            'users' => $users,
            'residences' => $residences,
            'orders' => $orders
        ]);
    }
}
