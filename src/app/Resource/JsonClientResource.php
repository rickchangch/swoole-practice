<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class JsonClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
