#!/bin/sh
#cd ../
CURL="$(which curl)"
$CURL -u "jarnailboparai:boparai@2010" -d '{ "name": "'$1'", "private": false }' https://api.github.com/user/repos
