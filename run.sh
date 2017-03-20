#!/usr/bin/env bash

php artisan serve &
PHP=`pidof "php artisan serve"`
echo $PHP
cd ionic && ionic serve
IONIC=`pidof ionic serve`

kill -9 <<< echo $PHP
cd ..
