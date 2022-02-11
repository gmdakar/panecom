#!/bin/bash

echo "git add . && git commit -m "new commmit" && git push"
git add . && git commit -m "new commmit" && git push

echo "drush -y cex && git status"
drush -y cex && git status