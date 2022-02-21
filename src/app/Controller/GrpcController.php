<?php

declare(strict_types=1);

namespace App\Controller;

use app\Grpc\ElixirClient;
use Grpc\Client;
use Grpc\ClientIndexRequest;
use Grpc\ClientIndexResponse;
use Grpc\ClientViewRequest;
use Grpc\ClientViewResponse;

/**
 * gRPC Client
 */
class GrpcController extends AbstractController
{
    public function index()
    {
        // new a client connection
        $client = new ElixirClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);

        $req = new ClientIndexRequest();

        /** @var ClientIndexResponse $reply **/
        list($reply, $status) = $client->indexClient($req);

        $resp = $reply->getClients();

        // print_r($resp);
        // var_dump($status);

        return json_encode((array) $resp);
    }

    public function view()
    {
        // new a client connection
        $client = new ElixirClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);

        $req = new ClientViewRequest();
        $req->setId(1);

        /** @var ClientViewResponse $resp */
        list($resp, $status) = $client->viewClient($req);

        $res = $resp->getClient();
        var_dump($res);
        var_dump($status);

        return json_encode((array) $res);
    }
}
