<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Residence;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Residence
     */
    private $residence;

    public function __construct(Order $order, User $user, Residence $residence)
    {
        $this->order = $order;
        $this->user = $user;
        $this->residence = $residence;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->with(['user', 'residence.street'])->get();

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residences = $this->residence->with('street')->get();

        return view('admin.orders.create', [
            'residences' => $residences
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $data = $request->all();

        $user = $this->user->findOrFail($request['user']);
        $residence = $this->residence->findOrFail($request['residence']);

        $order = $this->order->user()->associate($user);
        $order->residence()->associate($residence);
        $order->fill($data)->save();

        return redirect()->route('admin.orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $residences = $this->residence->with('street')->get();
        $order->load(['user', 'residence.street']);
        $users = $order->residence->users;

        return view('admin.orders.edit', [
            'order' => $order,
            'residences' => $residences,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\OrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $data = $request->all();

        $user = $this->user->findOrFail($request['user']);
        $residence = $this->residence->findOrFail($request['residence']);

        $order->user()->associate($user);
        $order->residence()->associate($residence);
        $order->fill($data)->save();

        return redirect()->route('admin.orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index');
    }
}
