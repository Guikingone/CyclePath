FROM alpine as core

RUN apk add --no-cache openssl

RUN openssl genrsa -des3 -passout pass:NotSecure -out cert.pass.key 2048
RUN openssl rsa -passin pass:NotSecure -in cert.pass.key -out cert.key
RUN rm cert.pass.key
RUN openssl req -new -passout pass:NotSecure -key cert.key -out cert.csr \
    -subj '/C=SS/ST=SS/L=Random Place/O=Cycle Path Dev/CN=localhost'
RUN openssl x509 -req -sha256 -days 365 -in cert.csr -signkey cert.key -out cert.crt

FROM nginx:alpine as base

ARG WORKFOLDER

ENV WORKPATH ${WORKFOLDER}

RUN mkdir -p /etc/nginx/ssl

COPY --from=core cert.key cert.crt /etc/nginx/ssl/

COPY conf/core/core.conf /etc/nginx/nginx.conf

COPY conf/development/cyclepath.conf /etc/nginx/conf.d/default.conf

COPY . ${WORKPATH}

## Production
FROM base as production

COPY conf/production/cyclepath.conf /etc/nginx/conf.d/default.conf
