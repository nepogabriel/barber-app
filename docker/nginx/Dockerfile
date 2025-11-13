FROM nginx:alpine

# Remove config padrão
RUN rm /etc/nginx/conf.d/default.conf

# Copia config customizada
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf.template

# Copia somente os arquivos públicos do Laravel
COPY ./public /var/www/public

# Copia entrypoint customizado
COPY ./docker/nginx/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]