@extends('layouts.master');
@section('title', 'user Page')
@section('content')
<h1>Welcome</h1>
<p>this is user page</p>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone No</th>
            <th scope="col">Photograph</th>
            <th scope="col">Created At</th>
            <th scope="col">actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td><img src="{{asset($user->photograph)}}" width="50px" height="50px" alt="image"></td>
            <td>{{$user->created_at->format('d-m-y h:i:s A')}}</td>
            <td>
                <a href="" class="btn btn-primary btn-sm">update</a>
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach

        @endsection
    </tbody>
</table>
