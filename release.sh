#!/bin/bash

TEMP=`getopt -o Mmf --long major,minor,fix -- "$@"`
eval set -- "$TEMP"

while true; do
    case "$1" in
        -M|--major)
            type='major'; shift;;
        -m|--minor)
            type='minor'; shift;;
        -f|--fix)
            type='fix'; shift;;
        --)
            shift; break;;
    esac
done

currentVersion=$(grep version package.json | grep -oP '\d*\.\d*\.\d*')

IFS='.' read -ra ADDR <<< "$currentVersion"
major=${ADDR[0]}
minor=${ADDR[1]}
fix=${ADDR[2]}

if [[ "$type" = "" ]]; then
    version=$1
else
    if [[ "$type" = 'major' ]]; then
        major=$(( major + 1 ))
        minor=0
        fix=0
    fi
    if [[ "$type" = 'minor' ]]; then
        minor=$(( minor + 1 ))
        fix=0
    fi
    if [[ "$type" = 'fix' ]]; then
        fix=$(( fix + 1 ))
    fi

    version="$major.$minor.$fix"
fi

read -p "Release version $version? (Y/n) " answer

if [[ "$answer" = "n" ]]; then
    exit 0
fi

date=$(date +%F)

echo "Updating package.json file to version ${version}"
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" package.json

echo "Updating version-control.json to version ${version} and last updated to ${date}"
sed -i "s/\"version\": \".*\"/\"version\": \"${version}\"/" version-control.json
sed -i "s/\"last_updated\": \".*\"/\"last_updated\": \"$date\"/" version-control.json

echo "Updating prayer-global-porch.php to version ${version}"
sed -i "s/Version:.*/Version: ${version}/" prayer-global-porch.php

echo 'Pushing new tag to master'
git add .
git commit -m "Release ${version}"
git tag ${version}
git push --tags origin master