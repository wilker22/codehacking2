@extends('layouts.admin')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($photos as $photo)
                   
        <tr>
            <td scope="row">{{$photo->id}}</td>
            <td><img height="50" src="{{$photo->file}}" alt=""></td>
            <td>{{$photo->created_at}}</td>
            <td>{{$photo->email}}</td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger'])  !!}
                    </div>

                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection