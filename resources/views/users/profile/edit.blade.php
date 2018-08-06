@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card topmargin nopadding">
                    <div class="card-header">
                        <span class="text-uppercase">{{ __('Your Profile') }}</span>
                    </div>
                    <div class="card-body">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ Form::open(['route' => ['profile.update', $id], 'file' => true, 'method' => 'put', 'id' => 'profile', 'enctype' => 'multipart/form-data']) }}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            {!! Form::label(__('Name')) !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('Email')) !!}
                            {!! Form::text('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter mail']) !!}
                        </div>
                        <div class="form-group">
                            <img src="{{ $user->avatar }}" class="img-circle ava-height60">
                            {!! Form::label(__('Avatar')) !!}
                            {!! Form::file('image', null, ['type' => 'file', 'id' => 'image']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label(__('Password')) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'autocomplete' => 'off']) !!}
                        </div>
                        {!! Form::submit(__('Update'), ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
