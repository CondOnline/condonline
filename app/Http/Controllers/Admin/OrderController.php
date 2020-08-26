<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Residence;
use App\Models\User;
use App\Traits\FileTrait;

class OrderController extends Controller
{
    use FileTrait;

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
        $data = $request->validated();

        $user = $this->user->findOrFail($request['user']);
        $residence = $this->residence->findOrFail($request['residence']);

        if ($request->hasFile('image')){
            $data['image'] = $this->fileUpload($request->image, 'order');
        }

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
        $data = $request->validated();

        $user = $this->user->findOrFail($request['user']);
        $residence = $this->residence->findOrFail($request['residence']);

        if ($request->hasFile('image')){
            $data['image'] = $this->fileUpload($request->image, 'order');
        }

        if ($data['delivered_at']){
            if ($request->hasFile('image_signature')){
                $data['image_signature'] = $this->fileUpload($request->image_signature, 'order');
            }
        }elseif ($order->image_signature){
            $this->removeFile($order->image_signature, 'order');
            $data['image_signature'] = NULL;
        }

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

    public function image(Order $order)
    {
        $response = $this->getFile($order->image, 'order');

        return $response;
    }

    public function removeImage(Order $order)
    {
        $this->removeFile($order->image, 'order');

        $order->update([
            'image' => NULL
        ]);

        return redirect()->back();
    }

    public function imageSignature(Order $order)
    {
        $response = $this->getFile($order->image_signature, 'order');

        return $response;
    }
}
