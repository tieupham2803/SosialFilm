@extends('backend.layouts.main')

@section('content')
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="single-post nobottommargin">
                    <div id="comments" class="clearfix">
                        <div id="respond" class="clearfix">
                            <h3>{!! __('Create an') . ' ' !!}<span>{!! __('Actor') !!}</span></h3>
                            {!! Form::open(['route' => ['actors.store'], 'method' => 'post', 'class' => 'clearfix', 'id' => 'commentform', 'enctype' => 'multipart/form-data']) !!}
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col_one_third">
                                    {!! Form::label(__('Name')) !!}
                                    {!! Form::text('name', null, ['class' => 'sm-form-control']) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col_one_sixth">
                                    {!! Form::label(__('Date of birth')) !!}
                                    {!! Form::text('birthday', null, ['class' => 'sm-form-control', 'id' => 'datepicker', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col_one_third">
                                    {!! Form::label(__('Country')) !!}
                                    {!! Form::text('country', null, ['class' => 'sm-form-control']) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col_one_third">
                                    {!! Form::label(__('Avatar')) !!}
                                    {!! Form::file('image', null, ['type' => 'file', 'id' => 'image']) !!}
                                </div>
                            </div>

                            <div class="clear"></div>
                            <div class="row">
                                <div class="col_full">
                                    {!! Form::label(__('Information')) !!}
                                    {!! Form::textarea('information', null, array('class' => 'sm-form-control', 'cols' => 58, 'rows' => 7, 'id' => 'ckeditor')) !!}
                                </div>
                            </div>
                            <div class="col_full nobottommargin">
                                {!! Form::submit(__('Submit'), array('class' => 'button button-3d nomargin')) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $( function() {
            $( '#datepicker' ).datepicker({ dateFormat: 'dd-mm-yy' });
        } );
    </script>
@endsection

