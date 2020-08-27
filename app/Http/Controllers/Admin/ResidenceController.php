<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidenceRequest;
use App\Models\Residence;
use App\Models\Street;
use Illuminate\Http\Request;

class ResidenceController extends Controller
{
    /**
     * @var Residence
     */
    private $residence;
    /**
     * @var Street
     */
    private $street;

    public function __construct(Residence $residence, Street $street)
    {
        $this->residence = $residence;
        $this->street = $street;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residences = $this->residence
                        ->with('street')
                        ->get()
                        ->sortBy(function($query){
                                    return $query->street->short;
                                })
                        ->sortBy('number')
                        ->all();

        return view('admin.residences.index', [
            'residences' => $residences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streets = $this->street->all();
        $users = \App\Models\User::whereDweller(1)->get();

        return view('admin.residences.create',[
            'streets' => $streets,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ResidenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResidenceRequest $request)
    {
        $data = $request->validated();

        $street = $this->street->findOrFail($data['street']);

        $residence = $street->residences()->create($data);
        if (!empty($data['users']))
            $residence->users()->sync($data['users']);

        return redirect()->route('admin.residences.show', [
            'residence' => $residence
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function show(Residence $residence)
    {
        $residence->load(['street', 'users']);

        return view('admin.residences.show', [
            'residence' => $residence
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function edit(Residence $residence)
    {
        $streets = $this->street->all();
        $users = \App\Models\User::whereDweller(1)->get();

        return view('admin.residences.edit', [
            'residence' => $residence,
            'streets' => $streets,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ResidenceRequest  $request
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function update(ResidenceRequest $request, Residence $residence)
    {
        $data = $request->validated();

        $street = $this->street->findOrFail($data['street']);

        $residence->update($data);
        $street->residences()->save($residence);

        if (!empty($data['users'])){
            $residence->users()->sync($data['users']);
        } else{
            $residence->users()->detach();
        }

        return redirect()->route('admin.residences.show', [
            'residence' => $residence
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Residence $residence)
    {
        if ($residence->orders()->count() || $residence->users()->count())
            return redirect()->back();

        $residence->delete();

        return redirect()->route('admin.residences.index');
    }

    public function users(Request $request)
    {
        $users = $this->residence->findOrFail($request->residence)->users()->whereDweller(1)->get(['id', 'name']);
        return response()->json($users);
    }
}
