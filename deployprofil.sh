#!/bin/bash

echo "git add . && git commit -m "new commmit" && git push"
git add . && git commit -m "new commit" && git push

echo "drush -y cex && git status"
drush -y cex && git status

echo "rm -rf modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content"
rm -rf modules/custom/mydefaultcontent/content && drush dcer node --folder=modules/custom/mydefaultcontent/content && drush dcer menu_link_content --folder=modules/custom/mydefaultcontent/content