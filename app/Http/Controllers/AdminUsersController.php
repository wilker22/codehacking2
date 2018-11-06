<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;

use App\User;
use App\Role;

class AdminUsersController extends Controller
{
  
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {

        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

   
    public function store(UsersRequest $request)
    {
        //return $request->all();
        User::create($request->all());

        return redirect('/admin/users');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
