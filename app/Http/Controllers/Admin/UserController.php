<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\SendNewUserEmail;
use App\Models\User;
use App\Models\UserAccessGroup;
use App\Traits\FileTrait;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use FileTrait;

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
        $residences = \App\Models\Residence::with('street')->get();

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
        $data = $request->validated();
        $password = Str::random(10);
        $data['dweller'] = isset($data['dweller'])??false;
        $data['blocked'] = false;
        $data['password'] = bcrypt($password);

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);
        $user = $userAccessGroup->users()->create($data);
        if (!empty($data['residences']) && $user->dweller)
            $user->residences()->sync($data['residences']);

        SendNewUserEmail::dispatch($user, $password);

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
        $residences = \App\Models\Residence::with('street')->get();

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
        $data = $request->validated();
        $data['dweller'] = isset($data['dweller'])??false;
        $data['blocked'] = isset($data['blocked'])??false;

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);

        $user->update($data);
        $userAccessGroup->users()->save($user);

        if (!empty($data['residences']) && $user->dweller){
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
        if ($user->orders()->count() || $user->residences()->count())
            return redirect()->back();

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function photo(User $user)
    {
        $response = $this->getFile($user->photo, 'userPhoto');

        return $response;
    }

    public function removePhoto(User $user)
    {
        $this->removeFile($user->photo, 'userPhoto');

        $user->update([
            'photo' => NULL
        ]);

        return redirect()->back();
    }
}
