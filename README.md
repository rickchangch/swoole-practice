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
        # specify the relative path
        protoc -I=grpc/ --php_out=grpc/ grpc/*.proto
        # using grpc plugin
        protoc -I=grpc/ --php_out=plugins=grpc:grpc/ grpc/*.proto
        # same as above line
        protoc -I=grpc/ --php_out=grpc/ --grpc_out=grpc/ grpc/*.proto
        # using `grpc_php_plugin`, but you should compile grpc/grpc source before executing this command.
        protoc --php_out=./ --grpc_out=./ --plugin=protoc-gen-grpc=/var/www/grpc/bins/opt/grpc_php_plugin *.proto
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
- gen resource
    ```
    # generate single resource
    php bin/hyperf.php gen:resource {RESOURCE_NAME}
    # generate resource collection
    php bin/hyperf.php gen:resource {RESOURCE_NAME} --collenction
    php bin/hyperf.php gen:resource {RESOURCE_NAME}Collenction
    # generate grpc resource
    php bin/htperf.php gen:resource {RESOURCE_NAME} --grpc
    ```
- install protoc plugin and origin php grpc lib
    - from source
        ```bash
        # compile from source with c-implementation
        git clone -b v1.34.1 --depth 1 https://github.com/grpc/grpc && \
        cd grpc && \
        git submodule update --init && \
        make grpc_php_plugin

        # if alert some header files missed
        apk add linux-headers

        # or just install it with php-implementation but get lower performance
        composer require grpc/grpc:~1.44.0
        ```
    - from pecl
        ```bash
        # another resolution is that install it through the pecl,
        # but the alpine do not prepare pear as default,
        # you should install it in the begin.
        curl -o go-pear.php https://pear.php.net/go-pear.phar
        php go-pear.php
        pecl install grpc

        # and then install grpc-php-plugin via pecl
        git clone -b v1.34.1 --depth 1 https://github.com/grpc/grpc && \
        cd grpc && \
        git submodule update --init && \
        make grpc_php_plugin

        # and you will get file path of the `grpc_php_plugin`
        /var/www/grpc/bins/opt/grpc_php_plugin

        # use it through the protoc command
        protoc --php_out=./ --grpc_out=./ --plugin=protoc-gen-grpc=/var/www/grpc/bins/opt/grpc_php_plugin *.proto
        ```
- use seeder for creating db default data
    ```bash
    # gen code
    php bin/hyperf.php gen:seeder CreateClientsTableSeeder

    # run seed
    php bin/hyperf.php db:seed

    # run specified seed
    php bin/hyperf.php db:seed --path=seeders/<FILE_NAME>.php
    ```
