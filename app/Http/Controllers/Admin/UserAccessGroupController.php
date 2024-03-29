<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccessGroupRequest;
use App\Models\Permission;
use App\Models\UserAccessGroup;
use Illuminate\Support\Facades\Gate;

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
        $userAccessGroups = $this->userAccessGroup->whereNotIn('id', [1])->oldest('title')->get();

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
        if(Gate::denies('admin.userAccessGroups.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $userAccessGroup = $this->userAccessGroup->create($data);

        if (!empty($data['permissions']))
            $userAccessGroup->permissions()->sync($data['permissions']);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Grupo de acesso cadastrado com sucesso!'
            ]
        );

        return redirect()->route('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
        ])->with('toastr', $toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function show(UserAccessGroup $userAccessGroup)
    {
        if ($userAccessGroup->id == 1)
            return redirect()->back();

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
        if ($userAccessGroup->id == 1)
            return redirect()->back();

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
        if(Gate::denies('admin.userAccessGroups.edit')){
            abort(403, 'This action is unauthorized.');
        }

        if ($userAccessGroup->id == 1)
            return redirect()->back();

        $data = $request->validated();

        $userAccessGroup->update($data);
            if (!empty($data['permissions'])){
                $userAccessGroup->permissions()->sync($data['permissions']);
            }else{
                $userAccessGroup->permissions()->detach();
            }

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Grupo de acesso alterado com sucesso!'
            ]
        );

        return redirect()->route('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccessGroup $userAccessGroup)
    {
        if ($userAccessGroup->users()->count() || $userAccessGroup->id == 1)
            return redirect()->back();

        $userAccessGroup->permissions()->detach();

        $userAccessGroup->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Grupo de acesso removido com sucesso!'
            ]
        );

        return redirect()->route('admin.userAccessGroups.index')->with('toastr', $toastr);
    }
}
