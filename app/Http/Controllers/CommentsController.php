<?php

namespace App\Http\Controllers;

use App\Events\ReviewCommented;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Comment;
use App\Review;
use App\User;
use App\Notification;
use Auth;
use Carbon\Carbon;
use App\Events\Commented;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $data['content'] = $request->get('content');
            $data['is_reply_to'] = $request->get('is_reply_to');
            $data['review_id'] = $request->get('review_id');
            $data['user_id'] = Auth::user()->id;
            $comment = Comment::create($data);
            event(new Commented($comment));

            $data_noti['from_user_id'] = User::findOrFail($data['user_id'])->id;
            $data_noti['read'] = 0;
            $data_noti['click'] = 0;
            if ($data['is_reply_to'] == 0) {
                $data_noti['to_user_id'] = Review::findOrFail($data['review_id'])->user_id;
                $data_noti['type'] = 'commented';
                $data_noti['type_id'] = $data['review_id'];
            } else {
                $data_noti['to_user_id'] = Comment::findOrFail($data['is_reply_to'])->user_id;
                $data_noti['type'] = 'replied';
                $data_noti['type_id'] = $data['is_reply_to'];
            }

            if ($data_noti['from_user_id'] != $data_noti['to_user_id']) {
                $noti = Notification::create($data_noti);
                event(new ReviewCommented($noti->id));
            }
            return $comment;
        } else {
            return view('/login');
        }
    }
    public function fetch(Request $request)
    {
        $result = [];
        $comments = Comment::where(['is_reply_to' => 0, 'review_id' => $request->get('review_id')])
            ->orderBy('created_at', 'DESC')->get();
        foreach ($comments as $comment) {
            try {
                $tmp = [];
                $email = User::findOrFail($comment['user_id'])->email;
                $created_at = Carbon::parse($comment['created_at'])->format('H:m d M Y');
                $content = $comment['content'];
                $id = $comment['id'];
                $avatar = User::findOrFail($comment['user_id'])->avatar;
                array_push($tmp, $email, $created_at, $content, $id, $avatar);
                array_push($result, $tmp);
            } catch (ModelNotFoundException $e) {
                return $e->getMessage();
            }
        }
        return json_encode($result);
    }
    public function fetch2(Request $request)
    {
        $result = [];
//        $replies = Comment::where(['is_reply_to' => $request->get('is_reply_to')])
        $replies = Comment::where('is_reply_to', '<>', '0')->where('review_id', '=', $request->get('review_id'))
            ->orderBy('created_at', 'DESC')->get();
        foreach ($replies as $reply) {
            try {
                $tmp = [];
                $email = User::findOrFail($reply['user_id'])->email;
                $created_at = Carbon::parse($reply['created_at'])->format('H:m d M Y');
                $content = $reply['content'];
                $id = $reply['id'];
                $avatar = User::findOrFail($reply['user_id'])->avatar;
                $is_reply_to = $reply['is_reply_to'];
                array_push($tmp, $email, $created_at, $content, $id, $avatar, $is_reply_to);
                array_push($result, $tmp);
            } catch (ModelNotFoundException $e) {
                return $e->getMessage();
            }
        }
        return json_encode($result);
    }
}
