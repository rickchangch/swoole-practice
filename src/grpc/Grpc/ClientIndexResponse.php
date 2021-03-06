<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: schema.proto

namespace Grpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>grpc.ClientIndexResponse</code>
 */
class ClientIndexResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .grpc.Client clients = 1;</code>
     */
    private $clients;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Grpc\Client[]|\Google\Protobuf\Internal\RepeatedField $clients
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Schema::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .grpc.Client clients = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Generated from protobuf field <code>repeated .grpc.Client clients = 1;</code>
     * @param \Grpc\Client[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setClients($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Grpc\Client::class);
        $this->clients = $arr;

        return $this;
    }

}

