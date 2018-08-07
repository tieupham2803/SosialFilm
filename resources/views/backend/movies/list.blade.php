@extends('backend.layouts.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('message.movie-list') }}</h3>
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
            <table class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                    <tr align="center">
                        <th>{{ trans('message.stt') }}</th>
                        <th>{{ trans('message.name') }}</th>
                        <th>{{ trans('message.poster') }}</th>
                        <th>{{ trans('message.trailer') }}</th>
                        <th>{{ trans('message.genre') }}</th>
                        <th>{{ trans('message.actor') }}</th>
                        <th>{{ trans('message.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($stt=1)
                    @foreach ($movies as $cal)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $stt++ }}</td>
                            <td>{{ $cal->title }}</td>
                            <td><div><img class = "img-movie" src="{{ asset($cal->poster) }}" /></div></td>
                            <td>{{ $cal->trailer }}</td>
                            <td>
                                @foreach($genres as $genre_movie)
                                    @if($genre_movie->movie_id == $cal->id)
                                        {{ $genre_movie->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($actors as $actor_movie)
                                    @if($actor_movie->movie_id == $cal->id)
                                        {{ $actor_movie->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                {{ Form::open(['method' =>'GET', 'route' => ['movies.edit', $cal->id],'class' => 'form-update']) }}
                                {{ Form::submit('Edit', ['class' => 'btn btn-info']) }}
                                {{ Form::close() }}
                                {{ Form::open(['method' => 'delete','route' => ['movies.destroy', $cal->id], 'class' => 'form-delete', 'onsubmit' =>  'return xacnhanxoa("' . trans('message.confirm-delete') . '")']) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <a href="{{ route('movies.create') }}" class="btn btn-primary">{{ trans('message.add-movie') }}</a>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#dataTables').DataTable({
                'order': [[ 0, 'desc' ]],
            });
        });

        function xacnhanxoa(msg) {
            if(window.confirm(msg)) {
                return true;
            }
            return  false;
        }
    </script>
@endsection
