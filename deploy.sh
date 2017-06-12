chmod 600 /tmp/d360_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/d360_travis
git remote add wpengine-staging git@git.wpengine.com:staging/defense360.git # add remote for staging site
git push wpengine-staging master #deploy to staging site