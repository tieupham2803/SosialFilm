@extends('layouts.app')

@section('content')
<br>
<div class="container">

        <div class="col-md-12">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            <div class="row content" id="list-movies">
                @foreach ($movies as $movie)
                    <div class="col-sm-5 movie" >
                        <div class="">
                            <div class="panel-heading">
                            <H3> <a href="{{ route('moviedetails.show', $movie->id) }}">{!! $movie->title !!}</a></H3>
                            </div>
                            <div class="entry-image">
                                <a href="#"><img src="{{ asset($movie->poster) }}" alt="Blog Single"></a>
                            </div>
                            <div class="">
                                <p>
                                    <h5>
                                    @lang('message.runtime')    <span class="price">{{ $movie->runtime }} @lang('message.minutes') </span>
                                    </h5>
                                </p>
                                {!! Form::open(['route' => ['reviews.createId', $movie->id], 'method' => 'get', 'class' => 'detail']) !!}
                                    {!! Form::submit(trans('message.createmovie'), ['class' => 'btn btn-primary btn-detail']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            {{ $movies->links() }}
                        </div>
                    </div>
            </div>

    </div>
</div>
    {{-- <script src="http://sosialfilm.test/bower_components/select2/dist/js/select2.min.js"></script> --}}

@endsection


