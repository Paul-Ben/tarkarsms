<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{
    public function index(User $user)
    {
        $title = 'Admin Dashboard - User Manager';

        $users = User::paginate(10);
        return view('admin.user.index', ['users' => $users, 'title' => $title]);
    }

    public function create()
    {
        $title = 'Admin Dashboard - Create User';
        $roles = Role::all();
        return view('admin.user.create', ['title' => $title, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        event(new Registered($user));
        return redirect()->route('admin.manageuser')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {

        $title = 'Edit User';
        $roles = Role::all();
        return view('admin.user.edit', ['title' => $title, 'user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role_id' => ['required'],
        ]);
        $user->update($validated);

        return redirect()->route('admin.manageuser')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.manageuser')->with('success', 'User deleted!');
    }

    public function searchuser(Request $request)
    {
        $title = 'Admin - User Search';
        $query = $request->input('query');
        if ($query) {
            // Fetch study sessions matching the search query
            $users = User::where('name', 'like', '%' . $query . '%')
                ->paginate(20);
        } else {
            // Fetch all study sessions if no search query
            $users = User::paginate(20);
        }

        // Return the search results to the view
        return view('admin.userManage', compact('title', 'users', 'query'));
    }

    public function userResetPassword(User $user)
    {
        $user->password = Hash::make('Userpassword');
        $user->save();
        return redirect()->route('admin.manageuser')->with('success', 'User password reset successfully');
    }
}
