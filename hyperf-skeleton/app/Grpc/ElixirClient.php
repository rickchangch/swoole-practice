<?php

declare(strict_types=1);

namespace app\Grpc;

use Grpc\ClientIndexRequest;
use Grpc\ClientIndexResponse;
use Grpc\ClientViewRequest;
use Grpc\ClientViewResponse;
use Grpc\HiReply;
use Grpc\HiUser;
use Hyperf\GrpcClient\BaseClient;

class ElixirClient extends BaseClient
{
    public function indexClient(ClientIndexRequest $req)
    {
        return $this->_simpleRequest(
            '/grpc.elixir/indexClient',
            $req,
            [ClientIndexResponse::class, 'decode']
        );
    }

    public function viewClient(ClientViewRequest $req)
    {
        return $this->_simpleRequest(
            '/grpc.elixir/viewClient',
            $req,
            [ClientViewResponse::class, 'decode']
        );
    }
}
