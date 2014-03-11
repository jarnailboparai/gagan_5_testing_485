#!/bin/sh
#cd ../
GIT="$(which git)"
pwd
cd ./gittest/$1
$GIT init .
$GIT add .
$GIT commit -m "$1"
$GIT remote add origin git@github.com:jarnailboparai/$1.git
$GIT push -u origin master
