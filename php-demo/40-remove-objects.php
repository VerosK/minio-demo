<?php

require __DIR__ . '/00-s3-common.php';


$BUCKET_NAME = 'public';
$OBJECT_NAME = 'index.txt';

// more examples at
// https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/php_s3_code_examples.html

// full documentation at
// https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#deleteobjects

try {
	$contents = $s3->deleteObjects([
		'Bucket' => $BUCKET_NAME,
		'Delete' => [
			'Objects' => [ // up to 1000 keys
				['Key' =>  $OBJECT_NAME ],
			],
		],
	]);

	foreach ($contents['Deleted'] as $deleted) {
		echo(" * " . $deleted['Key'] . " was deleted from $BUCKET_NAME\n");
	}

} catch (Exception $exception) {
	echo "Failed to drop objects in $BUCKET_NAME with error: " . $exception->getMessage();
	exit("Please fix error before continuing.");
}

