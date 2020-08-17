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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userAccessGroup = $this->userAccessGroup->with('users')->findOrFail($id);

        return view('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
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
        $userAccessGroup = $this->userAccessGroup->findOrFail($id);

        return view('admin.userAccessGroups.edit', [
            'userAccessGroup' => $userAccessGroup
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

        $userAccessGroup = $this->userAccessGroup->findOrFail($id);
        $userAccessGroup->update($data);

        return redirect()->route('admin.userAccessGroups.show', [
            'userAccessGroup' => $userAccessGroup
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
        $userAccessGroup = $this->userAccessGroup->findOrFail($id);

        if ($userAccessGroup->users()->count())
            return redirect()->back();

        $userAccessGroup->delete();

        return redirect()->route('admin.userAccessGroups.index');
    }
}
