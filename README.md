# swoole-practice

This project is used for practicing the gRPC and coruntine with PHP coruninte framework `hyperf` which based on the `swoole` and `swow`.

## Start-up

- `.env` setting
    ```
    APP_NAME=skeleton
    APP_ENV=dev

    DB_DRIVER=mysql
    DB_HOST=mysqldb
    DB_PORT=3306
    DB_DATABASE=main_db
    DB_USERNAME=root
    DB_PASSWORD=root
    DB_CHARSET=utf8mb4
    DB_COLLATION=utf8mb4_unicode_ci
    DB_PREFIX=
    ```
- deply project at the local environment
    ```
    bash scripts/commands.sh -t deploy-local -a DEPLOY_ENV=stage

    # kill it
    bash scripts/commands.sh -t kill-local
    ```
- dev steps when `DEPLOY_ENV=dev`
    - start a shell on app container for dev purpose
        ```
        docker exec -it app /bin/bash
        ```
    - start server
        ```
        php bin/hyperf.php start

        # start with hot reload
        php bin/hyperf.php server:watch
        ```
        or modify `docker-files/entrypoint/init.sh` to run hot reload server automatically

## Dev notes

- install hyperf
    ```
    composer create-project hyperf/hyperf-skeleton src
    ```
- develop in Docker
    - image from hyperf registry
        ```shell
        docker run --name hyperf \
        -v /Users/rick/projects/code/swoole-practice/src:/data/project \
        -p 9501:9501 -it \
        --privileged -u root \
        --entrypoint /bin/sh \
        hyperf/hyperf:8.0-alpine-v3.14-swoole
        ```
    - build with Dockerfile
        ```shell
        docker build hyperf:dev ./hyper-skeleton

        docker run --name hyperf \
        -v /Users/rick/projects/code/swoole-practice/src:/data/project \
        -p 9501:9501 -it \
        --privileged -u root \
        --entrypoint /bin/sh \
        hyperf:dev
        ```
- hot reload
    - see more: https://hyperf.wiki/2.2/#/zh-tw/awesome-components?id=%e7%86%b1%e6%9b%b4%e6%96%b0%e7%86%b1%e9%81%8e%e8%bc%89
    - offical lib
        ```shell
        # install
        composer require hyperf/watcher --dev
        # generate config file
        php bin/hyperf.php vendor:publish hyperf/watcher
        # start server with hot reload
        php bin/hyperf.php server:watch
        ```
- protoc
    - compile .proto
        ```
        cd grpc && protoc --php_out=. *.proto
        # OR
        protoc -I=grpc/ --php_out=grpc/ grpc/*.proto
    ```
    - autoload
        ```
        "autoload": {
            "psr-4": {
                "App\\": "app/",
                "GPBMetadata\\": "grpc/GPBMetadata",
                "Grpc\\": "grpc/Grpc"
            },
            "files": [
            ]
        },
        ```
        execute `composer dump-autoload` to activate autoload
    - (x)install gRPC dependencies
        ```
        composer require hyperf/grpc-server
        composer require hyperf/grpc-client
        ```
- allow alter column function: `change()`
    ```
    composer require "doctrine/dbal:^3.0"
    ```
