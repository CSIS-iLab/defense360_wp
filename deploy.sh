chmod 600 /tmp/d360_travis
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/d360_travis
git remote add defense360_wp git@git.wpengine.com:staging/defense360.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status
git checkout development
git add wp-content/themes/defense360/*.css
git commit -m "compiled assets"
git push defense360_wp development:master #deploy to staging site from development to master