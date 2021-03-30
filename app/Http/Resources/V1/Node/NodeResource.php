<?php

namespace App\Http\Resources\V1\Node;

use Illuminate\Http\Resources\Json\JsonResource;

class NodeResource extends JsonResource
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
            'id'        => $this->id,
            'parent_id' => $this->when($this->parent_id,$this->parent_id),
            'name'      => $this->name,
            'parent'    => $this->when($this->parents, new NodeResource($this->whenLoaded('parents'))),

        ];
    }
}
