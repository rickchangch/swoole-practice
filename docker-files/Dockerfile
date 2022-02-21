FROM hyperf/hyperf:8.0-alpine-v3.14-swoole

LABEL maintainer="Atelli Developers <...@atelli.ai>" version="1.0"

ARG DEPLOY_ENV

# env settings
ENV APP_DIR=/var/www/html \
    DEPLOY_ENV=${DEPLOY_ENV:-"dev"}

# setup application
RUN mkdir -p ${APP_DIR}
WORKDIR ${APP_DIR}
COPY ./src .

# install composer
RUN composer install \
    --no-cache \
    --ignore-platform-reqs

# setup entrypoint
COPY ./docker-files/entrypoint/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh
ENTRYPOINT ["/usr/local/bin/init.sh"]

EXPOSE 9501 9503
