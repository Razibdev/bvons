<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use App\Model\Post\Post;
use App\Rules\checkPostBodyAndMediaIsEmpty;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Upload;


class PostController extends Controller
{

    use PostLike;

    public function index($user_id = null)
    {
        if($user_id === null) return auth()->user()->postWithUser()->latest()->paginate(10);

        $user = User::find($user_id);

        if($user) return $user->postWithUser()->latest()->paginate(5);

        return response()->json(["error" => "invalid user id"], 422);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => [new checkPostBodyAndMediaIsEmpty([$request->media])],
            'media' => [new checkPostBodyAndMediaIsEmpty([$request->body])],
        ]);

        if($request->missing(['body', 'media'])) {
            return response()->json(["error" => "Please send body and media"], 422);
        }
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);

        $mediaData = json_decode($request->media, true);

        if($request->media === "" || $request->media === null) {
            $uploadedFileList = null;
        } else {
            $uploadedFileList = Upload::storeMediaFromBase64($mediaData, 'post', '/' . $post->user->id . '/' .$post->id);

        }
        $updatePost = Post::find($post->id)->update([
            "media" => $uploadedFileList ? json_encode($uploadedFileList) : NULL,
        ]);
        $post = Post::find($post->id);
        return response()->json([
                "message"        => "Success",
                "id"            => $post->id,
                "body"          => $post->body,
                "media"         => $post->media,
                "media_url"     => $post->generateMediaUrl(),

                "created_at"    => $post["created_at"],
                "updated_at"    => $post["updated_at"],
                "user"              => [
                "id"            => $post->user["id"],
                "name"          => $post->user["name"],
                "verified"      => $post->user["verified"],
                "profile_pic"   => $post->user["profile_pic"],
                "phone"         => $post->user["phone"],
                "created_at"    => $post->user["created_at"],
                "updated_at"    => $post->user["updated_at"],
                "storage_url"     => $post->user->mediaUrl(),
            ]
        ]);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        if($request->missing(['body', 'media'])) {
            return response()->json(["error" => "Please send body and media"], 422);
        }
        $request->validate([
            'body' => [new checkPostBodyAndMediaIsEmpty([$request->media])],
            'media' => [new checkPostBodyAndMediaIsEmpty([$request->body])],
        ]);

        Storage::disk('post')->deleteDirectory($post->user->id . '/' . $post->id);

        $mediaData = json_decode($request->media, true);

        if($request->media === "" || $request->media === null) {
            $uploadedFileList = null;
        } else {
            $uploadedFileList = Upload::storeMediaFromBase64($mediaData, 'post', '/' . $post->user->id . '/' .$post->id);
        }

        $post->body = $request->body;
        $post->media = $uploadedFileList ? json_encode($uploadedFileList) : NULL;
        if($post->save()) {
            return $post;
        }
    }

    public function destroy(Post $post)
    {
        $deletePost = auth()->user()->posts()->where('id', $post->id)->delete();
        if($deletePost) {
            Storage::disk('post')->deleteDirectory($post->user->id . '/' . $post->id);
            return $deletePost;
        }
    }


}
