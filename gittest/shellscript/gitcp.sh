#!/bin/sh
#cd ../
CP="$(which cp)"
pwd
$CP -ar ./applications/$1 ./gittest/
