<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{

    /**
     * @var Group
     */
    private $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->group->oldest('title')->get();

        return view('admin.groups.index', [
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('admin.groups.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        if(Gate::denies('admin.groups.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $group = $this->group->create($data);

        if (!empty($data['users']))
            $group->users()->sync($data['users']);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Grupo cadastrado com sucesso!'
            ]
        );

        return redirect()->route('admin.groups.show', [
            'group' => $group
        ])->with('toastr', $toastr);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $group->load('users');

        return view('admin.groups.show', [
            'group' => $group
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $users = User::all();

        return view('admin.groups.edit', [
            'group' => $group,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        if(Gate::denies('admin.groups.edit')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $group->update($data);

        if (!empty($data['users'])){
            $group->users()->sync($data['users']);
        }else{
            $group->users()->detach();
        }

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Grupo alterado com sucesso!'
            ]
        );

        return redirect()->route('admin.groups.show', [
            'group' => $group
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->users()->detach();

        $group->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Grupo removido com sucesso!'
            ]
        );

        return redirect()->route('admin.groups.index')->with('toastr', $toastr);
    }
}
