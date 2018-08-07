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

        {!! Form::open(['method' => 'POST', 'route' => ['movies.store'], 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label(trans('message.movie_name')) !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('message.name'), 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label( trans('message.selectgenre')) !!}
                {!! Form::select('genre_id[]', $genre, null, ['multiple' => true, 'class' => 'select2 sm-form-control fix-select',  'size' => '5']) !!}
                <a href="{{ route('genres.create') }}" class="btn btn-primary">{{ trans('message.add-genre') }}</a>
            </div>
            <div class="form-group">
                {!! Form::label( trans('message.selectactor')) !!}
                {!! Form::select('actor_ids[]', $actors, null, [ 'multiple'=> true , 'class' => 'select2 sm-form-control fix-select', 'size' => '5']) !!}
                <a href="{{ route('actors.create') }}" class="btn btn-primary">{{ trans('message.add-actor') }}</a>
            </div>
            <div class="form-group">
                {!! Form::label( trans('message.select-country')) !!}
                {!! Form::select('country_id', $countries, null, [ 'class' => 'select2 sm-form-control fix-select', 'size' => '5']) !!}
            </div>
            <div class="form-group">
                {!! Form::label( trans('message.select-poster')) !!}
                {!! Form::file('image', null, ['type' => 'file']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.director')) !!}
                {!! Form::text('director', null, ['class' => 'form-control', 'placeholder' => trans('message.director')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.overview')) !!}
                {!! Form::textarea('overview', null, ['class' => 'form-control', 'id' => 'my-editor', 'cols' => 58, 'rows' => 7, 'placeholder' => trans('message.overview')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.runtime')) !!}
                {!! Form::text('runtime', null, ['class' => 'form-control', 'placeholder' => trans('message.runtime')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.trailer')) !!}
                {!! Form::text('trailer', null, ['class' => 'form-control', 'placeholder' => trans('message.trailer')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.imdb_score')) !!}
                {!! Form::text('imdb_score', null, ['class' => 'form-control', 'placeholder' => trans('message.imdb_score')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('message.realease_date')) !!}
                {!! Form::text('realease_date', null, ['class' => 'sm-form-control', 'id' => 'datepicker', 'autocomplete' => 'off']) !!}
            </div>
            {!! Form::button(trans('message.add-movie'), ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
</div>

@section('script')
    <script>
        $( function() {
            $( '#datepicker' ).datepicker({ dateFormat: 'dd-mm-yy' });
        } );
    </script>
@endsection
@endsection

