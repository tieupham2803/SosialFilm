@foreach($comments as $comment)
    <div class="display-comment">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->content }}</p>
        <a href="" id="reply"></a>
        {{ Form::open(['method' => 'POST', 'route' => 'reply.add']) }}
        {{ Form::text('content', null, ['class' => 'form-control']) }}
        {{ Form::hidden('review_id', $review_id) }}
        {{ Form::hidden('comment_id', $comment->id) }}
        {{ Form::submit(__('Reply'), ['class' => 'btn btn-warning']) }}
        {{ Form::close() }}
        @include('partials._comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach

