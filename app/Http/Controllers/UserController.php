<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    public function view()
    {
        $this->authorize('create', Product::class);
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function viewUser(User $user)
    {
        $this->authorize('create', Product::class);

        return view('admin.users.view', compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('create', Product::class);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $this->authorize('create', Product::class);
        return view('admin.users.create', compact('roles'));
    }



    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $user->save();
        return redirect()->route('admin.users.index');
    }


    public function update(User $user, Request $request)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $user->save();

        return redirect()->route('admin.users.view', $user);
    }







    public function destroy(User $user)
    {


        $user->delete();

        return redirect()->route('admin.users.index')->with('statusDelete', __('De gebruiker is verwijderd'));
    }
}
