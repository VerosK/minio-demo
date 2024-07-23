<?php

require __DIR__ . '/00-s3-common.php';


$BUCKET_NAME = 'public';
$OBJECT_NAME = 'index.txt';

// more examples at
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// full documentation at
// https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#listobjectsv2

try {
	$buckets = $s3->listBuckets([
	]);

	echo("Your buckets are: \n");
	foreach ($buckets['Buckets'] as $bucket) {
		echo "* " . $bucket['Name'] . "\n";
	}


} catch (Exception $exception) {
	echo "Failed to list buckets with error: " . $exception->getMessage();
	exit("Please fix error with listing objects before continuing.");
}


// more examples at
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// full documentation at
// https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#listobjectsv2

try {
	$contents = $s3->listObjectsV2([
		'Bucket' => $BUCKET_NAME,
	]);
	echo "The contents of your bucket are: \n";

	if (empty($contents['Contents'])) {
		echo "- No objects in bucket $BUCKET_NAME\n";
	} else
	foreach ($contents['Contents'] as $content) {
		echo "* " . $content['Key'] . "\n";
	}
} catch (Exception $exception) {
	echo "Failed to list objects in $BUCKET_NAME with error: " . $exception->getMessage();
	exit("Please fix error with listing objects before continuing.");
}
