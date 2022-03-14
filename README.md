# ttc--intervention-image
Prefixed intervention image for Ttc Library


This repo has 2 branches main and prefix with the second holding the prefixed files from [PHP-Prefixer](https://php-prefixer.com).

The purpose of the repo is to automate the process all issues regarding the library Intervention/image shoulde be reported upstream.

commands:

```
composer install --prefer-dist --no-progress
```

```
~/.composer/vendor/bin/rector process vendor
```

```
rm -rf vendor_prefixed && mv vendor vendor_prefixed
````
