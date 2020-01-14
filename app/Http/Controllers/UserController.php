<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Role;
use App\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $roles = Role::all();

        $users = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('users.index', compact(['users', 'data', 'roles']));
    }

    public function create()
    {
        return view('users.create', [
            'roles' => Role::all(),
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
        $user->load(['role']);

        return view(
            'users.show',
            ['user' => $user]
        );
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(StoreUserRequest $request, $id)
    {
        $data = $request->toArray();

        unset($data['_method'], $data['_token'], $data['password2']);

        $user = User::find($id);
        $user->update($data);

        return redirect()->route('users.show', $user);
    }

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

    public static function filterPagination($type, $value)
    {
        return User::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }

    private function saveData(Request $request, User $user): User
    {
        $user->name = $request->input('name');
        $user->surname = $request->input("surname");
        $user->email = $request->input("email");
        $user->type_document = $request->input("type_document");
        $user->document = $request->input("document");
        $user->role_id = $request->input("role_id");
        $user->state = true;
        $user->password = Hash::make($request->input('password'));
        $user->state = 1;
        $user->save();

        return $user;
    }
}
