#!/bin/bash
set -e -u

SCRIPT_DIR="$( cd "$( dirname "$0" )" && pwd )"
TASK=""
ARGS=""

while getopts "t:a:" option
do
  case $option in
    t)  TASK="$OPTARG"
        ;;
    a)  ARGS="$OPTARG"
        ;;
  esac
done

case "$TASK" in
  deploy-local)
    export "$ARGS"
    docker compose -f $SCRIPT_DIR/../docker-compose.yml up -d
    ;;
  kill-local)
    docker compose -f $SCRIPT_DIR/../docker-compose.yml down $ARGS
    ;;
  composer-install)
    docker compose exec app composer install --no-cache --ignore-platform-reqs
    ;;
  composer-require)
    docker compose exec app composer require --prefer-dist $ARGS --no-cache --ignore-platform-reqs
    ;;
  compile-proto)
    docker compose exec app bash -c "cd grpc && protoc --php_out=. *.proto"
    ;;
  gen-resource)
    # --grpc / --collection
    docker compose exec app php bin/hyperf.php gen:resource $ARGS
    ;;
esac
