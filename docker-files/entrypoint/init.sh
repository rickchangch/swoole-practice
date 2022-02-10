#!/bin/bash
set -e -u

case ${DEPLOY_ENV} in
    dev)
        apk add --no-cache protobuf
        exec /bin/bash
        ;;
    stage)
        php bin/hyperf.php start
        ;;
    prod)
        php bin/hyperf.php start
        ;;
esac

