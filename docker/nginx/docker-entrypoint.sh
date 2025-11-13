#!/bin/sh
set -e

# Substitui a variável de ambiente no template
envsubst '${LARAVEL_HOST}' \
  < /etc/nginx/conf.d/default.conf.template \
  > /etc/nginx/conf.d/default.conf

# Sobe o nginx
exec nginx -g 'daemon off;'
