#!/bin/bash

if [[ $# != 1 ]]; then
    echo 'Error: you must specify a version number'
    exit 1
fi

version=$1
date=$(date +%F)

## Update package.json
echo "Updating package.json file to version ${version}"

sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" package.json

## Update version-control.json
echo "Updating version-control.json to version ${version} and last updated to ${date}"

sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" version-control.json
sed -i "s/\"last_updated\": \".*\"/\"last_updated\": \"$date\"/" version-control.json

export PG_VERSION=$version

echo 'Pushing new tag to master'

git add .
git commit -m "chore: Release ${version}"
git tag ${version}
git push --tags origin master