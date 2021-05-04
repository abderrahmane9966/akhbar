<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'post_id' => $this->id,
            'post_title' => $this->title,
            'post_content' => $this->content,
            'post_image' => $this->featured_image,
            'date_written' => $this->date_written,
            'votes_up' => $this->votes_up,
            'votes_down' => $this->votes_down,
            'voters_up' => $this->voters_up,
            'voters_down' => $this->voters_down,
            'author' => $this->user->name,
            'post_category' => new CategoryResource($this->category),
            'post_comments' => CommentResource::collection($this->comments),
        ];
    }
}
