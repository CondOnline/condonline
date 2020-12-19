<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Jobs\NewOrderJob;
use App\Models\Order;
use App\Models\Residence;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        $orders = $this->order->with(['user', 'residence.street'])->latest('updated_at')->get();

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
        if(Gate::denies('admin.orders.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $user = $this->user->findOrFail($request['user']);
        $residence = $this->residence->findOrFail($request['residence']);

        if ($request->hasFile('image')){
            $data['image'] = $this->fileUpload($request->image, 'order');
        }

        $order = $this->order->user()->associate($user);
        $order->residence()->associate($residence);
        $order->fill($data)->save();

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Encomenda cadastrada com sucesso!'
            ]
        );

        return redirect()->route('admin.orders.show', [
            'order' => $order
        ])->with('toastr', $toastr);
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
    public function update(OrderUpdateRequest $request, Order $order)
    {
        if(Gate::denies('admin.orders.edit')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        if ($request->hasFile('image_signature')){
            $data['image_signature'] = $this->fileUpload($request->image_signature, 'order');
        }

        $order->update($data);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Encomenda alterada com sucesso!'
            ]
        );

        return redirect()->route('admin.orders.show', [
            'order' => $order
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DB::table('notifications')->where('data->tracking', $order->tracking)->delete();

        $this->removeFile($order->image, 'order');
        $this->removeFile($order->image_signature, 'order');
        $order->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Encomenda apagada com sucesso!'
            ]
        );

        return redirect()->route('admin.orders.index')->with('toastr', $toastr);
    }

    public function image(Order $order, $image)
    {
        if(Gate::denies('admin.orders.show')){
            abort(403, 'This action is unauthorized.');
        }

        $image = ($image == 'signature') ? $order->image_signature : $order->image;

        $response = $this->getFile($image, 'order');

        return $response;
    }

    public function removeImage(Order $order)
    {
        if(Gate::denies('admin.orders.edit')){
            abort(403, 'This action is unauthorized.');
        }

        $this->removeFile($order->image, 'order');

        $order->update([
            'image' => NULL
        ]);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Imagem apagada com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }
}
