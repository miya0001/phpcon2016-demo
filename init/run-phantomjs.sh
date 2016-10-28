#!/usr/bin/env bash

set -ex


phantomjs \
    --webdriver=4444 \
    --ignore-ssl-errors=yes \
    --cookies-file=/tmp/webdriver_cookie.txt \
    > /tmp/webdriver_output.txt &
