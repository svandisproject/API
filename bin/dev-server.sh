#!/usr/bin/env bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
$DIR/./console server:run &
$DIR/../node_modules/.bin/encore dev-server --hot
