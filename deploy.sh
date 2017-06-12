chmod 600 /tmp/d360_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/d360_travis
git remote add defense360_wp git@git.wpengine.com:staging/defense360.git # add remote for staging site
git checkout master
git add --all
git commit -m "compiled assets"
git push defense360_wp master #deploy to staging site