#!/bin/bash
cd ../"$1"
git init
git remote add origin git@github.com:jarnailboparai/$1.git
git pull
git add .
git commit -m "$1"
#git remote add origin git@github.com:jarnailboparai/$1.git
git push -u origin master
ls -l >> ../shellscript/lms.txt
