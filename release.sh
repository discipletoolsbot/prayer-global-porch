#!/bin/bash

if [[ $# != 1 ]]; then
    echo 'Error: you must specify a version number'
    exit 1
fi

version=$1
date=$(date +%F)

echo "Updating package.json file to version ${version}"
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" package.json

echo "Updating version-control.json to version ${version} and last updated to ${date}"
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" version-control.json
sed -i "s/\"last_updated\": \".*\"/\"last_updated\": \"$date\"/" version-control.json

echo "Updating prayer-global-porch.php to version ${version}"
sed -i "s/\"Version\":.*/\"Version\": ${version}/" prayer-global-porch.php

echo 'Pushing new tag to master'
git add .
git commit -m "Release ${version}"
git tag ${version}
git push --tags origin master