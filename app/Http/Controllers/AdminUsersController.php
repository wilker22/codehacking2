<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;

use App\User;
use App\Role;
use App\Photo;

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
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('/admin/users');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = Role::list('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'role')); 
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
