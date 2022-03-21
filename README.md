# ttc--intervention-image
Prefixed intervention image for Ttc Library


This repo is holding the prefixed files (added Ttc namespace) for the intervention Image library.

The purpose of the repo is to automate the process all issues regarding the library Intervention/image shoulde be reported upstream.

Assumes that rector is installed globally, eg: `composer global require rector/rector`
commands:

Install the library:

```
composer install --prefer-dist --no-progress
```

Process the library with Rector:

```
~/.composer/vendor/bin/rector process vendor
```

Fix the composer entries and move the prefixed files to the new directory:

```
rm -rf vendor_prefixed && mv vendor vendor_prefixed
````

Lastly, create a static classmap for the prefixed files:

```
npm i && npm run mapit
```
