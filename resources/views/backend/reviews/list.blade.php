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
                        <th>{{ trans('message.title') }}</th>
                        <th>{{ trans('message.movie') }}</th>
                        <th>{{ trans('message.author') }}</th>
                        <th>{{ trans('message.content') }}</th>
                        <th>{{ trans('message.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($stt=1)
                    @foreach ($reviews as $cal)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $stt++ }}</td>
                            <td>{{ $cal->title }}</td>
                            <td>{{ $cal->moviesTitle }}</td>
                            <td>{{ $cal->author }}</td>
                            <td>
                                {!! str_limit(strip_tags($cal->content), 400) !!}
                                @if (strlen(strip_tags($cal->content)) > 400)... <a href="{{ action('ReviewsController@show', $cal->id) }}" class="btn btn-info btn-sm">Read More</a>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ Form::open(['method' => 'delete','route' => ['review.destroy', $cal->id], 'class' => 'form-delete', 'onsubmit' =>  'return xacnhanxoa("' . trans('message.confirm-delete') . '")']) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <a href="{{ route('reviews.create') }}" class="btn btn-primary">{{ trans('message.add-movie') }}</a>
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
