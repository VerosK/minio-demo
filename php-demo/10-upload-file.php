<?php

require __DIR__ . '/00-s3-common.php';

$BUCKET_NAME = 'public';
$OBJECT_NAME = 'index.txt';

echo("Uploading to bucket: $BUCKET_NAME\n");

// Send a PutObject request and get the result object.

// Example from:
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// full docs
// https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#putobject

$insert = $s3->putObject([
     'Bucket' => $BUCKET_NAME,
     'Key'    => $OBJECT_NAME,
     'ContentType' => 'text/plain',  // Required for downloads to work in the browser

     'Body'   => 'Hello from Minio!!',
     // SourceFile' => __DIR__ . '/testfile.txt',
  ]);

// We're happy
echo("Uploaded index.txt\n");

// Get the effective URI
$effectiveUri = $insert['@metadata']['effectiveUri'];
echo("Uploaded as $effectiveUri\n");

// var_dump($insert);

