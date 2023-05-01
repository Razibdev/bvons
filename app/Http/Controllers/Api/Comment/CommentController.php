<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Model\Post\Post;
use App\Rules\checkPostBodyAndMediaIsEmpty;
use Illuminate\Http\Request;
use App\Model\Comment\Comment;


class CommentController extends Controller
{
    use CommentLike;
    public function get(Post $post)
    {
        return $post->commentWithUser()->latest()->get();
    }

    public function create(Request $request, Post $post)
    {

        if($request->missing(['body', 'media'])) {
            return response()->json(["error" => "Please send body and media"], 422);
        }

        $request->validate([
           "body" => [new checkPostBodyAndMediaIsEmpty([$request->media])],
           "media" => [new checkPostBodyAndMediaIsEmpty([$request->body])],
        ]);


        try {
            $c = Comment::create([
                "user_id"   => auth()->user()->id,
                "post_id"   => $post->id,
                "body"      => $request->body,
                "media"     => $request->media
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(["error" => $e->getMessage()], 422);
        }


        return [
            "message"       => "Success",
            "id"            => $c->id,
            "body"          => $c->body,
            "media"         => $c->media,
            "created_at"    => $c["created_at"],
            "updated_at"    => $c["updated_at"],
            "user"          => [
                "id"            => $c->user["id"],
                "name"          => $c->user["name"],
                "verified"      => $c->user["verified"],
                "profile"       => $c->user["profile_pic"],
                "phone"         => $c->user["phone"],
                "created_at"    => $c->user["created_at"],
                "updated_at"    => $c->user["updated_at"],
                "storage_url"     => $post->user->mediaUrl(),
            ]
        ];
    }

    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);
        $postOwner = $comment->post->user_id;

        if($postOwner === auth()->id() ) {
            return $comment->delete();
        }

        return auth()->user()->comments()->where('id', $comment_id)->delete();
    }

}
