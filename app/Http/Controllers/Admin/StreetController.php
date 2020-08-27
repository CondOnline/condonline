<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StreetRequest;
use App\Models\Street;

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
        $data = $request->validated();

        $street = $this->street->create($data);

        return redirect()->route('admin.streets.show', [
            'street' => $street
        ]);
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
        $data = $request->validated();

        $street->update($data);

        return redirect()->route('admin.streets.show', [
            'street' => $street
        ]);
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

        return redirect()->route('admin.streets.index');
    }
}
