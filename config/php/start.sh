#!/usr/bin/env bash

echo "run crontab"
exec crontab /etc/cron.d/app.crontab &

echo "run cron"
exec service cron start &

exec tail -f /var/log/cron.log &

echo "run php-fpm"
exec php-fpm