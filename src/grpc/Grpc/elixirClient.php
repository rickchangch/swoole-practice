<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Grpc;

/**
 */
class elixirClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Grpc\ClientViewRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function viewClient(\Grpc\ClientViewRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/grpc.elixir/viewClient',
        $argument,
        ['\Grpc\ClientViewResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Grpc\ClientIndexRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function indexClient(\Grpc\ClientIndexRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/grpc.elixir/indexClient',
        $argument,
        ['\Grpc\ClientIndexResponse', 'decode'],
        $metadata, $options);
    }

}
