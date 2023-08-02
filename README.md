# Prayer Global Porch

Prayer Global Porch is the core prayer app for the prayer.global website.

## Creating a release

Run

`npm run release:fix`
`npm run release:feature`
`npm run release:major`

This will generate the correct semver tag based off of the current tag found in package.json.

It will then create a new tag of this number on the current commit, change the version number in

* package.json
* version-control.json
* prayer-global-porch.php

This will trigger the github release action to create a new zip of the plugin with the correct release number.

Anywhere that is using the plugin, will then get an upgrade notice in WP.

## Content Attributions

<a href="https://www.freepik.com/free-vector/find-person-job-opportunity_8063764.htm#query=avatar&position=0&from_view=search&track=sph">Image by studiogstock</a> on Freepik

<a href="https://www.freepik.com/free-vector/diversity-interracial-community-people-flat-design-icons-concept_2611275.htm#from_view=detail_alsolike?log-in=google">Image by rawpixel.com</a> on Freepik