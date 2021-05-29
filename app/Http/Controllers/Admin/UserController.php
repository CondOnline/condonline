<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\SendNewUserEmail;
use App\Models\User;
use App\Models\UserAccessGroup;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use DataTables;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereNotIn('id', [1])->select();
            return DataTables::eloquent($data)
                ->filterColumn('cpf', function($query, $keyword) {
                    $sql = "cpf like ?";
                    $keyword = encryption($keyword);
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->toJson();
        }

        return view('admin.users.index');
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
        if(Gate::denies('admin.users.create')){
            abort(403, 'This action is unauthorized.');
        }

        $data = $request->validated();

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);
        $user = $userAccessGroup->users()->create($data);
        if (!empty($data['residences']) && $user->dweller)
            $user->residences()->sync($data['residences']);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Usuário cadastrado com sucesso!'
            ]
        );

        return redirect()->route('admin.users.show', [
            'user' => $user
        ])->with('toastr', $toastr);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->id === 1)
            return redirect()->back();

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
        if ($user->id === 1)
            return redirect()->back();

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
        if(Gate::denies('admin.users.edit')){
            abort(403, 'This action is unauthorized.');
        }

        if ($user->id === 1)
            return redirect()->back();

        $data = $request->validated();

        $userAccessGroup = $this->userAccessGroup->findOrFail($data['userAccessGroup']);

        $user->update($data);
        $userAccessGroup->users()->save($user);

        if (!empty($data['residences']) && $user->dweller){
            $user->residences()->sync($data['residences']);
        } else{
            $user->residences()->detach();
        }

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Usuário alterado com sucesso!'
            ]
        );

        return redirect()->route('admin.users.show', [
            'user' => $user
        ])->with('toastr', $toastr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->orders()->count() || $user->id == 1)
            return redirect()->back();

        $this->removeFile($user->photo, 'userPhoto');

        $user->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Usuário removido com sucesso!'
            ]
        );

        return redirect()->route('admin.users.index')->with('toastr', $toastr);
    }

    public function photo(User $user)
    {
        if(Gate::denies('admin.users.show')){
            abort(403, 'This action is unauthorized.');
        }

        $response = $this->getFile($user->photo, 'userPhoto');

        return $response;
    }

    public function removePhoto(User $user)
    {
        $this->removeFile($user->photo, 'userPhoto');

        $user->update([
            'photo' => NULL
        ]);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Foto apagada com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }
}
