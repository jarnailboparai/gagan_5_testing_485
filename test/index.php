<?php


$output = shell_exec('

touch README.md
git init
git add README.md
curl -u \'avetik:avetikgit1\' https://api.github.com/user/repos -d \'{"name":"REPO1"}\'
git remote add origin git@github.com:USER/REPO1.git
git push origin master

');
echo "<pre>$output</pre>";

/*
$command = "git commit -m 'I have modified a file ' 2>&1";
echo shell_exec($command);
exit();
*/
