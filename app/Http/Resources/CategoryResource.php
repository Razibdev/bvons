<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                => $this->id,
            "subcategory_id"    => $this->sub_categories,
            "category_name"     => $this->category_name,
            "category_url"      => $this->url,
            "categories_image"      => $this->categories_image,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
        ];
    }
}
