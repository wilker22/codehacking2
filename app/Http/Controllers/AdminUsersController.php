<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


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
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);

        }
        
      
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

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
        $role = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'role')); 
    }

   
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
      
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);

        }


        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        return redirect ('/admin/users');





    }

   
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        dd(unlink($user->photo->file));
        
        $user->delete();

        Session::flash('deleted_user', 'The User has been deleted!');

        return redirect('/admin/users');
    }

    
}
