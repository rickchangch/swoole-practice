<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Clients;
use App\Resource\ClientResource;
use App\Resource\ClientViewResponseResource;
use Grpc\Client;
use Grpc\ClientIndexRequest;
use Grpc\ClientIndexResponse;
use Grpc\ClientViewRequest;
use Grpc\ClientViewResponse;

/**
 * gRPC Server
 */
class ElixirController
{
    public function viewClient(ClientViewRequest $req)
    {
        $client = new Client();
        $client->setId(1);
        $client->setName('name');
        $client->setDescription('desc');

        $resp = new ClientViewResponse();
        $resp->setClient($client);
        return $resp;

        // return (new ClientViewResponseResource($resp))->toResponse();
    }

    public function indexClient(ClientIndexRequest $req)
    {
        $client = new Client();
        $client->setId(1);
        $client->setName('name');
        $client->setDescription('desc');

        $resp = new ClientIndexResponse();
        $resp->setClients([$client]);
        return $resp;
    }
}
