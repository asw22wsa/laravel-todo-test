<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'deadline' => ($this->deadline === null) ? "마감기간이 정해지지 않았습니다." : date('Y-m-d',strtotime($this->deadline)),
            'isDone' => $this->isDone,
            'updated_at' => $this->updated_at->diffForHumans()."전에 수정됨"
        ];
    }
}
