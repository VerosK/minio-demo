<?php

require __DIR__ . '/vendor/aws.phar';

date_default_timezone_set('America/Los_Angeles');

$s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        // do not change default region, Minio is started in fake "us-east-1"
        'region'  => 'us-east-1',
        'endpoint' => 'http://localhost:9000',
        // this is required for Minio-type setups
        'use_path_style_endpoint' => true,
        'credentials' => [
                'key'    => 'app-user',
                'secret' => 'password',
            ],
]);
