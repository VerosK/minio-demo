

# minio-demo

This is a simple demo of how to use Minio as an object storage.

# What is object storage ?

 * see: https://en.wikipedia.org/wiki/Object_storage

> Object storage (also known as object-based storage or blob storage) 
> is a computer data storage approach that manages data as "blobs" 
> or "objects", as opposed to other storage architectures like file 
> systems.

You don't have to worry about the file system, you just store and
retrieve objects. On the other hand, you don't have the same level
of control as you would with a classical file system. 


Probably the most famous object storage is Amazon S3, but there are 
others, such as Minio, which is an open-source object storage server.


## Pre-requisites

This demo was tested on `podman` and `podman-compose` on Fedora.
This should probably work on `docker` and `docker-compose` as well,
but I haven't tested it.


### Minio client

Minio client should be stored as `minioc`. You can download it from
[minio download page][download]

 * Windows - https://min.io/download?license=agpl&platform=windows
 * Linux - https://min.io/download?license=agpl&platform=linux

Linux on AMD64:

```bash
wget https://dl.min.io/client/mc/release/linux-amd64/mc -O ~/bin/minioc
chmod +x ~/bin/minioc
```

[download]: https://min.io/download


## How to start the demo

```bash
podman-compose up
```

should start minio and store all it's data to local `./minio-data` directory.

Check: https://localhost:9000 for minio page

Login: minioadmin
Password: minio123

Minio storage should be empty at the moment.

## How to play with demo

#### Create buckets

```bash
cd config/minio
bash create-bucket.sh
```

This creates two buckets: `data` and `cache`. 

Bucket named `data` can be used for storing data, while `cache` can be used for 
storing temporary data because of ILM


#### Create users

```bash
cd config/minio
bash create-user.sh
```

This should create user with policy to read and write to buckets.

### Run demo
 
You can use `minioc` to interact with minio or `aws s3 cli` if you have it installed.

Setup credentials:
```bash
export MINIO_API=http://localhost:9000
export MINIO_ADMIN_USER=minioadmin
export MINIO_ADMIN_PASSWORD=minio123
minioc alias set minio $MINIO_API $MINIO_ADMIN_USER $MINIO_ADMIN_PASSWORD
```

Usage:

```bash
# list buckets
minioc ls minio

# put local file to bucket names `data`
minioc put README.md minio/data
````


## aws cli (doesn't work)

One is able to use `aws s3` and `aws s3api` cli commands to interact with minio.

Beware: `aws` cli should be updated to 2023 or newer.

```shell
export AWS_ACCESS_KEY_ID=minioadmin
export AWS_SECRET_ACCESS_KEY=minio123
export AWS_DEFAULT_REGION=us-east-1
export AWS_ENDPOINT_URL_S3=http://localhost:9000

# friendly s3 ls
aws s3 ls

# raw api call
aws  s3api list-buckets
``` 

# Minio/S3 features

 * object/blob persistent storage
 * public / authorized access
 * put, get, list and delete calls
 * versioning
 * lifecycle policies
 * presigned URLs
 

### Advanced features:

 * range requests
 * multipart upload
 * encryption
 * access control
 * storage classes
 * event notifications
 * object locking
 * async replication to other buckets
 * ... many more


# License:

Use, abuse or remix.

 * CC0 or WTFPL
 
