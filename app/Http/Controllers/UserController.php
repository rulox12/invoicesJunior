<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:user list|user create|user edit|user delete', ['only' => ['index','show']]);
        $this->middleware('permission:user create', ['only' => ['create','store']]);
        $this->middleware('permission:user edit', ['only' => ['edit','update']]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $users = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('users.index', compact(['users', 'data']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', [
            'roles' => $roles,
            'userRole' =>[],
            'index' => true,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->saveData($request, new User());

        alert()->success(__('Successful'), __('Stored record'));

        return redirect()->route('users.show', $user);
    }


    public function show(User $user)
    {
        return view(
            'users.show',
            ['user' => $user]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * @param StoreUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUserRequest $request, $id)
    {
        $data = $request->toArray();

        unset($data['_method'], $data['_token'], $data['password2']);

        $user = User::find($id);
        $user->update($data);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.show', $user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        if ($user->state) {
            $data = ["state" => false];
        } else {
            $data = ["state" => true];
        }

        $user = User::find($user->id);
        $user->update($data);

        return redirect()->route('users.index');
    }

    /**
     * @param $type
     * @param $value
     * @return mixed
     */
    public static function filterPagination($type, $value)
    {
        return User::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    private function saveData(Request $request, User $user): User
    {
        $user->name = $request->input('name');
        $user->surname = $request->input("surname");
        $user->email = $request->input("email");
        $user->type_document = $request->input("type_document");
        $user->document = $request->input("document");
        $user->state = true;
        $user->password = Hash::make($request->input('password'));
        $user->state = 1;
        $user->assignRole($request->input('roles'));
        $user->save();

        return $user;
    }
}
