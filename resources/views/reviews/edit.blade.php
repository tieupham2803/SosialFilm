@extends('layouts.app')

@section('content')
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="heading-block center">
                    <h1><i class="icon-film"></i></h1>
                    <span>We make it awesome!</span>
                </div>
                <div class="single-post nobottommargin">
                    <div id="comments" class="clearfix">
                        <div id="respond" class="clearfix">
                            <h3>{{ __('Edit a') }} <span>Review</span></h3>
                            {!! Form::open(['route' => ['reviews.update', $id], 'method' => 'put', 'class' => 'clearfix', 'id' => 'commentform']) !!}
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {!! csrf_field() !!}

                            <div class="col_one_third">
                                {!! Form::label('Title') !!}
                                {!! Form::text('title', $review->title, array('class' => 'sm-form-control')) !!}
                            </div>
                            <div class="col_one_third">
                                {!! Form::label('Movie') !!}
                                {!! Form::select('movie_id', ['1' => 'Mission: Impossible', '2' => 'Avenger', '3' => 'Avenger2'], $review->movie_id, array('class' => 'select2 sm-form-control fix-select', 'placeholder' => 'Choose a film...')) !!}
                            </div>
                            <div class="clear"></div>
                            <div class="col_full">
                                {!! Form::label('Content') !!}
                                {!! Form::textarea('content', $review->content, array('class' => 'sm-form-control', 'cols' => 58, 'rows' => 7, 'id' => 'ckeditor')) !!}
                            </div>
                            <div class="col_full nobottommargin">
                                {!! Form::submit(__('Submit Review'), array('class' => 'button button-3d nomargin')) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
