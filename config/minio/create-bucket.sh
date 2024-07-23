#!/bin/bash
set -e
set -x

MINIO_API=${MINIO_API:-http://localhost:9000}
MINIO_ADMIN_USER=${MINIO_ADMIN_USER:-minioadmin}
MINIO_ADMIN_PASSWORD=${MINIO_ADMIN_PASSWORD:-minio123}

PUBLIC_BUCKET_NAME=${BUCKET_NAME:-public}
APP_BUCKET_NAME=${BUCKET_NAME:-data}
CACHE_BUCKET_NAME=${BUCKET_NAME:-cache}

minioc alias set minio $MINIO_API $MINIO_ADMIN_USER $MINIO_ADMIN_PASSWORD

if minioc ls minio/${PUBLIC_BUCKET_NAME}; then
    echo "Bucket ${PUBLIC_BUCKET_NAME} already exists, skipping"
  else
    echo "Creating bucket ${PUBLIC_BUCKET_NAME} ..."
    minioc mb minio/${PUBLIC_BUCKET_NAME}
    echo "OK"

    echo "Setting bucket policy for ${PUBLIC_BUCKET_NAME} ..."
    minioc policy set download minio/${PUBLIC_BUCKET_NAME}
    echo "OK"
fi

if minioc ls minio/${APP_BUCKET_NAME}; then
    echo "Bucket ${APP_BUCKET_NAME} already exists, skipping"
  else
    echo "Creating bucket ${APP_BUCKET_NAME} ..."
    minioc mb minio/${APP_BUCKET_NAME}
    minioc version enable minio/${APP_BUCKET_NAME}
    echo "OK"
fi


# set bucket policy to expire objects after 7 days
minioc ilm import minio/${APP_BUCKET_NAME} < ilm-expire-versions-policy.json



if minioc ls minio/${CACHE_BUCKET_NAME}; then
    echo "Bucket ${CACHE_BUCKET_NAME} already exists, skipping"
  else
    echo "Creating bucket ${CACHE_BUCKET_NAME}"
    minioc mb minio/${CACHE_BUCKET_NAME}
    echo "OK"
fi

# set bucket policy to expire objects after 7 days
minioc ilm rule import minio/${CACHE_BUCKET_NAME} < ilm-expire-all-policy.json
