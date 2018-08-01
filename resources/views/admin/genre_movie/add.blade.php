@extends('backend.layouts.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{ trans('message.genre-add-page') }}</h3>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="panel-body">
        {!! Form::open(['method' => 'POST', 'route' => ['genres.store']]) !!}
            <div class="form-group">
                {!! Form::label(trans('message.genre-name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('message.genre-name'), 'required' => 'required']) !!}
            </div>
            {!! Form::button(trans('message.add-genre'), ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
