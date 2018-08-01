@extends('backend.layouts.main')

@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{ trans('message.genre-edit-page') }}</h3>
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
        {{-- {!! Form::open(['method' => 'PUT','route' => ['genres.update', $cal->id]]) !!} --}}
         {{ Form::open(['route' => ['genres.update', $genre->id], 'method' => 'PUT']) }}
            <div class="form-group">
                {!!  Form::label(trans('message.genre-name')) !!}
                {!!  Form::text('name', $genre->name, ['class' => 'form-control', 'placeholder' => trans('message.genre-name'), 'required' => 'required']) !!}
            </div>
            {!!  Form::button(trans('message.genre-edit-page'), ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
