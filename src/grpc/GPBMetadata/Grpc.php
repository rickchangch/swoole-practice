<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: grpc.proto

namespace GPBMetadata;

class Grpc
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Schema::initOnce();
        $pool->internalAddGeneratedFile(
            '
?

grpc.protogrpc2?
elixirA

viewClient.grpc.ClientViewRequest.grpc.ClientViewResponse" D
indexClient.grpc.ClientIndexRequest.grpc.ClientIndexResponse" bproto3'
        , true);

        static::$is_initialized = true;
    }
}

