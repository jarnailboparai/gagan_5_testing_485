<?php

$cmd = "$ curl -u tayyabshabab@gmail.com -X PUT -d 'data={\"password\":\"tayyab\"}' https://build.phonegap.com/api/v1/keys/ios/32369";

$out = shell_exec($cmd);
		
?>
