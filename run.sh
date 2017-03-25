#!/usr/bin/env bash

php artisan serve &
PHP=$!
echo $PHP
cd ionic && ionic serve

kill -9 <<< echo $PHP
cd ..
