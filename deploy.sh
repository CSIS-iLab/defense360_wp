chmod 600 /tmp/d360_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/d360_travis
git remote add defense360_wp git@git.wpengine.com:staging/defense360.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/defense360/*.css -f # force all compiled CSS files to be added
git commit -m "compiled assets" # commit the compiled CSS files
git push -f defense360_wp master:master #deploy to staging site from master to master