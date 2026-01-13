<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        abort_unless(Auth::user()->role->name === 'admin', 403);

        return view('admin.users', [
            'users' => User::with('role')->get(),
            'roles' => Role::all(),
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        abort_unless(Auth::user()->role->name === 'admin', 403);

        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update([
            'role_id' => $request->role_id
        ]);

        return back();
    }
}
