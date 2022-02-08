# swoole-practice

- develop in Docker
    ```
    docker run --name hyperf \
    -v /Users/rick/projects/code/swoole-practice/hyperf-skeleton:/data/project \
    -p 9501:9501 -it \
    --privileged -u root \
    --entrypoint /bin/sh \
    hyperf/hyperf:8.1-alpine-v3.12-swoole
    ```
