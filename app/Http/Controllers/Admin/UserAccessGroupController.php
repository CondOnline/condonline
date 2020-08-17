<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserAccessGroup;
use Illuminate\Http\Request;

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
        $userAccessGroups = $this->userAccessGroup->orderBy('title', 'ASC')->get();

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
        return view('admin.userAccessGroups.create');
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

        $userAccessGroup = $this->userAccessGroup->create($data);

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
        return view('admin.userAccessGroups.edit', [
            'userAccessGroup' => $userAccessGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UserAccessGroup $userAccessGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAccessGroup $userAccessGroup)
    {
        $data = $request->all();

        $userAccessGroup->update($data);

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
