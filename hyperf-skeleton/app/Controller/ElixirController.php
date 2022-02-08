<?php

declare(strict_types=1);

namespace App\Controller;

use Grpc\Client;
use Grpc\ClientIndexRequest;
use Grpc\ClientIndexResponse;
use Grpc\ClientViewRequest;
use Grpc\ClientViewResponse;
use Grpc\HiReply;
use Grpc\HiUser;

/**
 * gRPC Server
 */
class ElixirController extends AbstractController
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
