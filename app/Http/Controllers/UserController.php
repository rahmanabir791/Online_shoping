<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addUser ()
    {
        return view('admin.user.add');
    }
    public function manageUser ()
    {
        return view('admin.user.manage', [
            'users' => User::all(),
        ]);
    }
    public function editUser ($id)
    {
        return view('admin.user.edit', [
            'user'  => User::find($id)
        ]);
    }

    public function deleteUser ($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('message', 'User deleted successfully.');
    }
    public function newUser (Request $request)
    {
        $user                   = new User();
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->password         = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('message', 'User created successfully.');
    }

    public function updateUser (Request $request, $id)
    {
        $user                   = User::find($id);
        $user->name             = $request->name;
        $user->email            = $request->email;
        if (isset($request->password))
        {
            $user->password         = bcrypt($request->password);
        }
        $user->save();
        return redirect('/manage-user')->with('message', 'User updated successfully.');
    }


}
