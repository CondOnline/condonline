<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\UserAccessGroup;

class UserController extends Controller
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var UserAccessGroup
     */
    private $userAccessGroup;

    public function __construct(User $user, UserAccessGroup $userAccessGroup)
    {
        $this->user = $user;
        $this->userAccessGroup = $userAccessGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('name', 'ASC')->get();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userAccessGroups = $this->userAccessGroup->all();
        $residences = \App\Residence::with('street')->get();

        return view('admin.users.create', [
            'userAccessGroups' => $userAccessGroups,
            'residences' => $residences
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt('12345678');

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);
        $user = $userAccessGroup->users()->create($data);
        if (!empty($data['residences']))
            $user->residences()->sync($data['residences']);

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['userAccessGroup', 'residences.street']);

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userAccessGroups = $this->userAccessGroup->all();
        $residences = \App\Residence::with('street')->get();

        return view('admin.users.edit', [
            'user' => $user,
            'userAccessGroups' => $userAccessGroups,
            'residences' => $residences
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);

        $user->update($data);
        $userAccessGroup->users()->save($user);
        if (!empty($data['residences'])){
            $user->residences()->sync($data['residences']);
        } else{
            $user->residences()->detach();
        }

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
