#!/bin/bash
set -e 
set -x

MINIO_API_ENDPOINT=${MINIO_API_ENDPOINT:-http://localhost:9000}
MINIO_ADMIN_USER=${MINIO_ADMIN_USER:-minioadmin}
MINIO_ADMIN_PASSWORD=${MINIO_ADMIN_PASSWORD:-minio123}

MINIO_APP_USER=${MINIO_APP_USER:-app-user}
MINIO_APP_PASSWORD=${MINIO_APP_PASSWORD:-password}


minioc alias set minio-admin $MINIO_API_ENDPOINT $MINIO_ADMIN_USER $MINIO_ADMIN_PASSWORD

# ensure user exists
if minioc admin user info minio-admin $MINIO_APP_USER; then
    echo "User ${APP_USER} already exists"
else
    echo "Creating user ${APP_USER} ..."
    minioc admin user add minio-admin $MINIO_APP_USER $MINIO_APP_PASSWORD
    echo "OK"
fi

# add alias
minioc alias set minio-app $MINIO_API_ENDPOINT $MINIO_APP_USER $MINIO_APP_PASSWORD

# create policy
if minioc admin policy info minio-admin $MINIO_APP_USER-policy; then
    echo "Policy already exists"
else
  echo "Creating RBAC policy ..."
  minioc admin policy add minio-admin $MINIO_APP_USER-policy rbac-enable-access.json
  echo "OK"
fi

echo "Attaching policy to user $MINIO_APP_USER..."
if ! minioc admin policy attach minio-admin $MINIO_APP_USER-policy --user=$MINIO_APP_USER; then
  echo "Policy already attached"
fi

