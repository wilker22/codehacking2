@extends('layouts.admin')



@section('content')

<h1>Edit Users</h1>

@include ('includes.form_error')

{!! Form::model($user, ['method'=> 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
  {{ csrf_field() }}
        <div class="form-group">
            {!! Form::label('name', 'Name:')!!}
            {!! Form::text('name', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:')!!}
            {!! Form::text('email', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:')!!}
            {!! Form::select('role_id', $role,  null, ['class' => 'form-control'])!!}
        </div>
        
        <div class="form-group">
            {!! Form::label('is_active', 'Is_active:')!!}
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:')!!}
            {!! Form::file('photo_id', null, ['class' => 'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:')!!}
            {!! Form::password('password', ['class' => 'form-control'])!!}
        </div>
 
        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>
    
{!! Form::close() !!}


@stop
