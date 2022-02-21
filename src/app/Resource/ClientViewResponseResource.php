<?php

namespace App\Resource;

use Grpc\ClientViewResponse;
use Hyperf\ResourceGrpc\GrpcResource;

class ClientViewResponseResource extends GrpcResource
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
            'client' => ClientResource::make($this->client),
        ];
    }

    /**
     * The grpc message for the resource.
     *
     * @return string
     */
    public function expect(): string
    {
        return ClientViewResponse::class;
    }
}
