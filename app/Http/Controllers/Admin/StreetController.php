<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StreetRequest;
use App\Models\Street;
use Illuminate\Support\Facades\Gate;

class StreetController extends Controller
{
    /**
     * @var Street
     */
    private $street;

    public function __construct(Street $street)
    {
        $this->street = $street;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $streets = $this->street->oldest('short')->get();

        return view('admin.streets.index', [
            'streets' => $streets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.streets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\StreetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StreetRequest $request)
    {
        if(Gate::denies('admin.streets.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $street = $this->street->create($data);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Rua cadastrada com sucesso!'
            ]
        );

        return redirect()->route('admin.streets.show', [
            'street' => $street
        ])->with('toastr', $toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        return view('admin.streets.show', [
            'street' => $street
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street)
    {
        return view('admin.streets.edit', [
            'street' => $street
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\StreetRequest  $request
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(StreetRequest $request, Street $street)
    {
        if(Gate::denies('admin.streets.edit')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $street->update($data);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Rua alterada com sucesso!'
            ]
        );

        return redirect()->route('admin.streets.show', [
            'street' => $street
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        if ($street->residences()->count())
            return redirect()->back();

        $street->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Rua removida com sucesso!'
            ]
        );

        return redirect()->route('admin.streets.index')->with('toastr', $toastr);
    }
}
