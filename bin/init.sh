#!/usr/bin/env bash

set -ex

curl http://getcomposer.org/installer | php
./composer.phar install
