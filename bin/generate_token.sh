#!/bin/bash

KEY_PASSWORD=`openssl rand -base64 12`

rm app/config/jwt.yml
rm -rf var/jwt
mkdir var/jwt

echo 'parameters:
    jwt_key_pass_phrase: '$KEY_PASSWORD > app/config/jwt.yml
openssl genrsa -passout pass:$KEY_PASSWORD -out var/jwt/private.pem -aes256 4096
openssl rsa -passin pass:$KEY_PASSWORD -pubout -in var/jwt/private.pem -out var/jwt/public.pem
