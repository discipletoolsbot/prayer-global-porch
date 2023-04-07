#!/bin/bash

echo $#

if [[ $# != 1 ]]; then
    echo 'Error: you must specify a version number'
    exit 1
fi

version=$1

## Update package.json
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" package.json

## Update version-control.json
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" version-control.json

date=$(date +%F)

sed -i "s/\"last_updated\": \".*\"/\"last_updated\": \"$date\"/" version-control.json