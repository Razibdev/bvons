<?php
namespace App\Http\Controllers\Api\User;

use App\Model\Product\Product;
use App\User;
use Illuminate\Http\Request;


trait UserTimeline {
    public function getTimeline(Request $request)
    {
        $request->validate([
            "call" => "required",
            "total_product_shown" => "required",
        ]);

        $user = auth()->user();
        $call = $request->call;
        $total_product_shown = $request->total_product_shown;

        $meta_data = [
            "total_product_shown" => $total_product_shown,
            "call" => $call,
            "total_product" => Product::all()->count()
        ];

        $followings = $user->followings()->orderBy("pivot_created_at", 'DESC')->get()->makeHidden('pivot');

        if(count($followings) === 0) return response()->json(["data" => "No Post Found", "meta-data" => $meta_data]);



        $posts = [];
        foreach ($followings as $following) {
            $posts[] = $following->posts()
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'profile_pic', 'verified');
                }])
                ->latest()
                ->take(1)
                ->skip($call)
                ->first();
        }
        $posts = collect($posts);
        $filter_posts = $posts->filter(function($post){ return $post !== null; })->values()->all();

        $array_chunk = array_chunk($filter_posts, 4);

        $count_item_to_product_fetch = count($array_chunk);

        $products = Product::take($count_item_to_product_fetch)->skip($total_product_shown)->latest()->get();



        $total_product_shown += count($products);

        $meta_data["total_product_shown"] = $total_product_shown;
        $meta_data["call"] = $meta_data["call"] + 1;

        $posts_with_product = [];
        for ($i = 0; $i < count($array_chunk); $i++) {
            if($i < count($products)) {
                $array_chunk[$i][] = $products[$i];
            }
            $posts_with_product[] = $array_chunk[$i];
        }

        return [
            "data" => $posts_with_product,
            "meta-data" => $meta_data
        ];
    }
}
