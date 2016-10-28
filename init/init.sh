#!/usr/bin/env bash

set -ex


curl http://getcomposer.org/installer | php
./composer.phar init -n
./composer.phar config bin-dir "bin/"
./composer.phar install
./composer.phar require \
    "behat/behat 3.*@stable" \
    "behat/mink 1.6.*@dev" \
    "behat/mink-extension 2.*@dev" \
    "behat/mink-browserkit-driver *@dev" \
    "behat/mink-goutte-driver *@dev" \
    "behat/mink-selenium2-driver *@dev" \
    --prefer-dist
