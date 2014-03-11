#!/bin/sh
#cd ../
#GIT="$(which git)"
pwd
cd ./gittest/$1
git init .
git add .
git commit -m "$1"
git remote add origin git@github.com:jarnailboparai/$1.git
git push -u origin master
