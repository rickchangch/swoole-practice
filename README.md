# swoole-practice

This project is used for practicing the gRPC and coruntine with PHP coruninte framework `hyperf` which based on the `swoole` and `swow`.

## Start-up

- deply project at the local environment
    ```
    bash scripts/commands.sh -t deploy-local -a DEPLOY_ENV=stage

    # kill it
    bash scripts/commands.sh -t kill-local
    ```

## Dev steps

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
