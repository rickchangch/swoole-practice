#!/bin/bash
set -e -u

php bin/hyperf.php migrate

case ${DEPLOY_ENV} in
    dev)
        apk add --no-cache protobuf
        exec /bin/bash
        # php bin/hyperf.php server:watch # use this command instead of above to enable hot reload when server running
        ;;
    stage)
        php bin/hyperf.php start
        ;;
    prod)
        php bin/hyperf.php start
        ;;
esac

