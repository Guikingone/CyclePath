FROM nginx:alpine as base

ARG WORKFOLDER

ENV WORKPATH ${WORKFOLDER}

## HTTP2
RUN apk add --no-cache --virtual .build-deps zip zlib-dev curl git go

COPY conf/core/core.conf /etc/nginx/nginx.conf

COPY conf/development/cyclepath.conf /etc/nginx/conf.d/default.conf

COPY . ${WORKPATH}

## Production
FROM base as production

COPY conf/production/cyclepath.conf /etc/nginx/conf.d/default.conf
