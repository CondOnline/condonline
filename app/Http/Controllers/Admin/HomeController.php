<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = \App\Models\User::whereNotIn('id', [1])->count();
        $residences = \App\Models\Residence::count();
        $orders = \App\Models\Order::whereNull('received')->count();
        $jobs = DB::table('jobs')->count();

        return view('admin.dashboard', [
            'users' => $users,
            'residences' => $residences,
            'orders' => $orders,
            'jobs' => $jobs
        ]);
    }
}
