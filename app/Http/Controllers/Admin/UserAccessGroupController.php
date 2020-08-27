<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessGroupRequest;
use App\Models\Permission;
use App\Models\UserAccessGroup;

class UserAccessGroupController extends Controller
{

    /**
     * @var UserAccessGroup
     */
    private $userAccessGroup;

    public function __construct(UserAccessGroup $userAccessGroup)
    {
        $this->userAccessGroup = $userAccessGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAccessGroups = $this->userAccessGroup->oldest('title')->get();

        return view('admin.userAccessGroups.index', [
            'userAccessGroups' => $userAccessGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.userAccessGroups.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\UserAccessGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAccessGroupRequest $request)
    {
        $data = $request->validated();

        $userAccessGroup = $this->userAccessGroup->create($data);

        if (!empty($data['residences']))
            $userAccessGroup->permissions()->sync($data['permissions']);

        return redirect()->route('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function show(UserAccessGroup $userAccessGroup)
    {
        $userAccessGroup->load('users');

        return view('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAccessGroup $userAccessGroup)
    {
        $permissions = Permission::all();

        return view('admin.userAccessGroups.edit', [
            'userAccessGroup' => $userAccessGroup,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UserAccessGroupRequest  $request
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UserAccessGroupRequest $request, UserAccessGroup $userAccessGroup)
    {
        $data = $request->validated();

        $userAccessGroup->update($data);
            if (!empty($data['residences'])){
                $userAccessGroup->permissions()->sync($data['permissions']);
            }else{
                $userAccessGroup->permissions()->detach();
            }


        return redirect()->route('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccessGroup $userAccessGroup)
    {
        if ($userAccessGroup->users()->count())
            return redirect()->back();

        $userAccessGroup->delete();

        return redirect()->route('admin.userAccessGroups.index');
    }
}
