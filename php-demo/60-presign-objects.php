<?php

require __DIR__ . '/00-s3-common.php';

$BUCKET_NAME = 'data';
$OBJECT_NAME = 'index.txt';

// more examples at
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// Full example:
// https://github.com/awsdocs/aws-doc-sdk-examples/blob/main/php/example_code/s3/PresignedURL.php

$expires = new DateTime('+10 minutes');

$command = $s3->getCommand('GetObject', [
		'Bucket' => $BUCKET_NAME,
		'Key' => $OBJECT_NAME
	]);

$preSignedRequest = $s3->createPresignedRequest($command, $expires);

$presignedUrl = $preSignedRequest->getUri();

echo("Pre-signed URL: $presignedUrl\n");
