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
    docker compose -f $SCRIPT_DIR/../docker-compose.yml down -v
    ;;
  composer-install)
    docker compose exec app composer install --no-cache --ignore-platform-reqs
    ;;
  composer-require)
    docker compose exec app composer require --prefer-dist $ARGS --no-cache --ignore-platform-reqs
    ;;
esac
