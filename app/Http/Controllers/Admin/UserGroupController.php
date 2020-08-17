<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{

    /**
     * @var UserGroup
     */
    private $userGroup;

    public function __construct(UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGroups = $this->userGroup->orderBy('title', 'ASC')->get();

        return view('admin.userGroups.index', [
            'userGroups' => $userGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.userGroups.create');
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

        $userGroup = $this->userGroup->create($data);

        return redirect()->route('admin.userGroups.show', [
            'userGroup' => $userGroup
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
        $userGroup = $this->userGroup->with('users')->findOrFail($id);

        return view('admin.userGroups.show', [
            'userGroup' => $userGroup
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
        $userGroup = $this->userGroup->findOrFail($id);

        return view('admin.userGroups.edit', [
            'userGroup' => $userGroup
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

        $userGroup = $this->userGroup->findOrFail($id);
        $userGroup->update($data);

        return redirect()->route('admin.userGroups.show', [
            'userGroup' => $userGroup
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
        $userGroup = $this->userGroup->findOrFail($id);

        if ($userGroup->users()->count())
            return redirect()->back();

        $userGroup->delete();

        return redirect()->route('admin.userGroups.index');
    }
}
