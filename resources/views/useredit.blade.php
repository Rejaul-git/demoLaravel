@extends('layouts.master');
@section('title', 'Home Page')
@section('content')
<h1>Edit User</h1>
<p>This is user edit page</p>
<div class="container">
    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        <div class="mb-3"></div>
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
        <div class="mb-3"></div>
        <label for="phone" class="form-label">Phone No</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone_no}}">
        <div class="mb-3"></div>
        <label for="photograph" class="form-label">Photograph</label>
        <input type="file" class="form-control" id="photograph" name="photograph" value="{{$user->photograph}}">
        <img src="{{asset($user->photograph)}}" width="50px" height="50px" alt="image">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection