

# PHP demo of S3

Get AWS SDK for PHP according to [AWS SDK for PHP documentation][aws-sdk-php-setup]

```shell
wget https://docs.aws.amazon.com/aws-sdk-php/v3/download/aws.phar -O php-demo/vendor/aws.phar
```

# Run demo in container

I don't have PHP installed on my machine, so I run the demo in a container.

### Check PHP is working

```shell
cd php-demo

podman run --rm -it -v .:/src:Z  docker.io/library/php:8.2-cli php /src/01-hello-world.php
```

### Upload file to S3/Minio

```shell
cd php-demo
podman run --rm -it --network host -v .:/src:Z  docker.io/library/php:8.2-cli php /src/10-upload-file.php
```

Check the file is present in Minio.

### Download file from S3/Minio

```shell
cd php-demo
podman run --rm -it --network host -v .:/src:Z  docker.io/library/php:8.2-cli php /src/20-retrieve-object.php
```

## Presigned 

[aws-sdk-php-setup]: https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html

