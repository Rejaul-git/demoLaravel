@extends('layouts.master');
@section('title', 'Home Page')
@section('content')
<h1>Welcome</h1>
<p>this is home page</p>
<div style="max-width: 500px; margin: 50px auto; padding: 30px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3 style="text-align:center; margin-bottom:20px; color:#343a40;">Contact Form</h3>

    {!! Form::open(['url' => route('register.submit'), 'method' => 'POST']) !!}

    <div class="mb-3">
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your name']) !!}
    </div>

    <div class="mb-3">
        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email']) !!}
    </div>
    <!-- password -->
    <div class="mb-3">
        {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter your password']) !!}
    </div>

    {!! Form::submit('Save', ['class' => 'btn btn-primary w-100', 'style' => 'padding:10px; font-size:16px;']) !!}

    {!! Form::close() !!}
</div>

@endsection