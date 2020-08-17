<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var UserGroup
     */
    private $userGroup;

    public function __construct(User $user, UserGroup $userGroup)
    {
        $this->user = $user;
        $this->userGroup = $userGroup;
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
        $userGroups = $this->userGroup->all();

        return view('admin.users.create', [
            'userGroups' => $userGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt('12345678');

        $userGroup = $this->userGroup->findOrFail($data['userGroup']);
        $user = $userGroup->users()->create($data);

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->with('userGroup')->findOrFail($id);

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        $userGroups = $this->userGroup->all();

        return view('admin.users.edit', [
            'user' => $user,
            'userGroups' => $userGroups
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $userGroup = $this->userGroup->findOrFail($data['userGroup']);
        $user = $this->user->findOrFail($id);

        $user->update($data);
        $userGroup->users()->save($user);

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
