<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAccessGroup;
use Illuminate\Http\Request;

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

        return view('admin.users.create', [
            'userAccessGroups' => $userAccessGroups
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

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);
        $user = $userAccessGroup->users()->create($data);

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
        $user = $this->user->with('userAccessGroup')->findOrFail($id);

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
        $userAccessGroups = $this->userAccessGroup->all();

        return view('admin.users.edit', [
            'user' => $user,
            'userAccessGroups' => $userAccessGroups
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

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);
        $user = $this->user->findOrFail($id);

        $user->update($data);
        $userAccessGroup->users()->save($user);

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
