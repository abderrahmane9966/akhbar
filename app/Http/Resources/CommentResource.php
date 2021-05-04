<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comment_id' => $this->id,
            'content' => $this->content,
            'date_written' => $this->date_written,
            'author' => $this->user->name,
            'post' => $this->post->title,
            'user' => new UserResource($this->user),
        ];
    }
}
