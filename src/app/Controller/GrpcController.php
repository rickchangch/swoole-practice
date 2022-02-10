<?php

declare(strict_types=1);

namespace App\Controller;

use Grpc\Client;
use Grpc\HiReply;
use Grpc\HiUser;

/**
 * gRPC Client
 */
class GrpcController extends AbstractController
{
    public function index()
    {
        // 這個client是協程安全的，可以複用
        $client = new \App\Grpc\ElixirClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);

        $req = new \Grpc\ClientIndexRequest();

        /**
         * @var \Grpc\ClientIndexResponse $reply
         */
        list($reply, $status) = $client->indexClient($req);

        $resp = $reply->getClients();
        // print_r($resp);
        // var_dump($status);

        var_dump(memory_get_usage(true));
        return json_encode((array) $resp);
    }

    public function view()
    {
        // 這個client是協程安全的，可以複用
        $client = new \App\Grpc\ElixirClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);

        $req = new \Grpc\ClientViewRequest();

        /**
         * @var \Grpc\ClientViewResponse $reply
         */
        list($reply, $status) = $client->viewClient($req);

        $resp = $reply->getClient();

        var_dump(memory_get_usage(true));
        return json_encode((array) $resp);
    }
}
