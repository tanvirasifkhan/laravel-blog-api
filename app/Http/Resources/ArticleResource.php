<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id'=>$this->id,
            'image'=>asset('images/'.$this->image),
            'title'=>$this->title,
            'body'=>$this->body,
            'category_title'=>$this->category->title,
            'category'=>$this->category_id,
            'author'=>$this->author->name
        ];
    }
}
