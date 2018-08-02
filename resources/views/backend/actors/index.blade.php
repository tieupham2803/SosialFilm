@extends('backend.layouts.main')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Actor list') }}</h3>
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
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Date of birth') }}</th>
                    <th>{{ __('Information') }}</th>
                    <th>{{ __('Avatar') }}</th>
                </tr>
                </thead>
                <tbody>
                @php ($stt=1)
                    @foreach ($actors as $cal)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $stt++ }}</td>
                            <td>{{ $cal->name }}</td>
                            <td>{{ date_format(date_create($cal->birthday), "d-m-Y") }}</td>
                            <td>{!! $cal->infor !!}</td>
                            <td><div><img src="{{ asset($cal->avarta) }}" /></div></td>
                            <td class="text-center">
                                {{ Form::open(['method' => 'GET', 'route' => ['actors.edit', $cal->id], 'class' => 'form-update']) }}
                                {{ Form::submit(__('Edit'), ['class' => 'btn btn-info']) }}
                                {{ Form::close() }}
                                {{ Form::open(['method' => 'delete', 'route' => ['actors.destroy', $cal->id], 'class' => 'form-delete', 'onsubmit' =>  'return xacnhanxoa("' . trans('message.confirm-delete') . '")']) }}
                                {{ Form::submit(__('Delete'), ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('actors.create') }}" class="btn btn-primary">{{ __('Create an actor') }}</a>
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
            if (window.confirm(msg)){
                return true;
            }
            return  false;
        }
    </script>
@endsection
