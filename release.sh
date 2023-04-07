#!/bin/bash

if [[ $# != 1 ]]; then
    echo 'Error: you must specify a version number'
    exit 1
fi

version=$1
date=$(date +%F)

echo "Updating package.json file to version ${version}"

## Update package.json
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" package.json

echo "Updating version-control.json to version ${version} and last updated to ${date}"
## Update version-control.json
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" version-control.json
sed -i "s/\"last_updated\": \".*\"/\"last_updated\": \"$date\"/" version-control.json

export PG_VERSION=$version