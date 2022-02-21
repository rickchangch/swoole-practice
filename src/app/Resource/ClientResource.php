<?php

namespace App\Resource;

use Grpc\Client;
use Hyperf\ResourceGrpc\GrpcResource;

class ClientResource extends GrpcResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        // return parent::toArray();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    /**
     * The grpc message for the resource.
     *
     * @return string
     */
    public function expect(): string
    {
        return Client::class;
    }
}
