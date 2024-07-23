<?php

require __DIR__ . '/00-s3-common.php';


$BUCKET_NAME = 'public';
$OBJECT_NAME = 'index.txt';

echo("Getting object from $BUCKET_NAME\n");

// more examples at
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// full documentation at
// https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#getobject

// Download the contents of the object.
$retrieve = $s3->getObject([
     'Bucket' => $BUCKET_NAME,
     'Key'    => $OBJECT_NAME,

     // possibly save the object
     // 'SaveAs' => 'testkey_local'
]);

// Display the object in the browser.

/// header("Content-Type: {$retrieve['ContentType']}");
// echo $retrieve['Body'];

echo("Object retrieved\n");

echo("\n--- 8< --- CUT HERE ---\n");
echo($retrieve['Body']);
echo("\n--- 8< --- CUT HERE ---\n");
