<?php

/**
 *   Author: Vitaliy Pitvalo
 *   Email: av.tehnik@gmail.com
 *   License: GPL
 *  
 */
class PhoneagpApi {

    private $ch;
    private $name;
    private $password;

    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_USERPWD, "$name:$password");
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
    }

    public function getApps() {
        $url = "https://build.phonegap.com/api/v1/apps";
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $output = curl_exec($this->ch);
        $obj = json_decode($output);
        return $obj->apps;
    }

    public function unlockKey($platform, $id, $keys) {


        $url = "https://build.phonegap.com/api/v1/keys/" . $platform . "/" . $id;
        $post = array(
            "data" => json_encode($keys),
        );

        curl_setopt($this->ch, CURLOPT_PUT, 1);


        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen(http_build_query($post))));
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($this->ch, CURLOPT_URL, $url);



        $output = curl_exec($this->ch);
        $obj = json_decode($output);
    }

    public function uploadApp($file, $title, $createMethod, $keys) {
        $url = "https://build.phonegap.com/api/v1/apps";
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        if (isset($keys)) {
            $post = array(
                "data" => json_encode(array('create_method' => $createMethod, 'title' => $title, "repo" => $file, 'private' => false, "keys" => $keys)),
            );
        } else {
            $post = array(
                "data" => json_encode(array('create_method' => $createMethod, 'title' => $title, "repo" => $file, 'private' => false)),
            );
        }

//        CVarDumper::dump($post,10,true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
        $output = curl_exec($this->ch);
        //CVarDumper::dump($output,10,true);die;


        $obj = json_decode($output);

        if (is_object($obj) && isset($obj->id)) {
            return $obj->id;
        } else {
            CVarDumper::dump($post, 10, true);
            CVarDumper::dump($output, 10, true);
            return false;
        }
    }

    public function checkApp($id) {
        $app = $this->getApp($id);
        if ($app) {
            return $app->status;
        } else {
            return false;
        }
    }

    public function getApp($id) {
        $url = "https://build.phonegap.com/api/v1/apps/" . $id;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $output = curl_exec($this->ch);
        $out = json_decode($output);
        if (is_object($out)) {
            return $out;
        } else {
            return false;
        }
    }

    public function getDownloadLink($id, $plateform) {
        if ($id) {
            $app = $this->getApp($id);
            if(property_exists($app, 'status'))
            {
            	
	            if ($app->status->{$plateform} == 'complete') {
	            	
	                $url = "https://build.phonegap.com" . $app->download->{$plateform};
	                curl_setopt($this->ch, CURLOPT_URL, $url);
	                $data = curl_exec($this->ch);
	                $data = json_decode($data);
	                if (is_object($data) && isset($data->location)) {
	                    return $data->location;
	                } else {
	                   return false;
	                }
	            }
            }else{
            	return false;
            }
        } else {
            return false;
        }
    }

    /*
      public function getDownloadLink($id, $platform) {
      $app = $this->getApp($id);
      if ($app->status->{$platform} == 'complete') {
      //            $data = file_get_contents("https://build.phonegap.com" . $app->download->{$platform}, false, $context);
      $data = "https://$this->name:$this->password@build.phonegap.com" . $app->download->{$platform};
      //            $data = file_get_contents("https://$this->name:$this->password@build.phonegap.com" . $app->download->{$platform});

      return $data;
      if (is_object($data) && isset($data->location)) {
      return $data;
      } else {
      false;
      }
      }
      }
     * 
     */

    public function deleteApp($id) {
        $url = "https://build.phonegap.com/api/v1/apps/" . $id;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $r = curl_exec($this->ch);
        return $r;
    }

    public function deleteApps() {
        $apps = $this->getApps();
        foreach ($apps as $app) {
            $this->deleteApp($app->id);
        }
    }

    public function setKeysIOS($title, $key_password = "", $cert = "", $profile = "") {
        $url = "https://build.phonegap.com/api/v1/keys/ios";
        $post = array(
            "data" => json_encode(array('title' => $title, "password" => $key_password)),
            "cert" => "@" . realpath($cert),
            "profile" => "@" . realpath($profile)
        );

        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($this->ch, CURLOPT_URL, $url);
        $output = curl_exec($this->ch);

        $out = json_decode($output);
        

        if (is_object($out)) {
            return $out;
        } else {
            CVarDumper::dump($post, 10, true);
            CVarDumper::dump($output, 10, true);
            return false;
        }
    }

    public function setKeysAndroid($title, $key_password, $alias, $key_password_alias, $key_file_path) {
        $url = "https://build.phonegap.com/api/v1/keys/android";

        $post = array(
            "data" => json_encode(array('title' => $title, 'alias' => $alias, 'key_pw' => $key_password, 'keystore_pw' => $key_password_alias)),
            "keystore" => "@" . realpath($key_file_path));

        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $output = curl_exec($this->ch);
        $out = json_decode($output);
        if (is_object($out)) {
            return $out;
        } else {
            return false;
        }
    }

    public function __destruct() {
        curl_close($this->ch);
    }
    
    public function uploadAppFile($file, $title, $createMethod, $keys=null) {
    	
  		$command11  = "curl -F file=@$file ";
  		$command11 .= "-u $this->name:$this->password ";
  		$command11 .= " -F 'data={\"title\":\"$title\",\"package\":\"build.soft.biz\",\"version\":\"0.1.0\",\"create_method\":\"$createMethod\"}' ";
  		$command11 .= " https://build.phonegap.com/api/v1/apps ";
    	//echo $command11;
  		$output = exec($command11);
    	//print_r($amrit);
    	
    	$obj = json_decode($output);
    	
    	if (is_object($obj) && isset($obj->id)) {
    		return $obj->id;
    	} else {
    		//CVarDumper::dump($post, 10, true);
    		CVarDumper::dump($output, 10, true);
    		
    		return false;
    	}
    	
    	
    }
    
    public function uploadAppMy($file, $title, $createMethod, $keys,$id) {
    	echo $url = "https://build.phonegap.com/api/v1/apps/".$id;
//     	curl_setopt($this->ch, CURLOPT_POST, 1);
//     	curl_setopt($this->ch, CURLOPT_URL, $url);
//     	if (isset($keys)) {
//     		$post = array(
//     				"data" => json_encode(array('create_method' => $createMethod, 'title' => $title, "repo" => $file, 'private' => false, "keys" => $keys)),
//     		);
//     	} else {
//     		$post = array(
//     				"data" => json_encode(array('create_method' => $createMethod, 'title' => $title, "repo" => $file, 'private' => false)),
//     		);
//     	}
    	
//     	$post = 'data={"pull":"true"}';
    
//     	//        CVarDumper::dump($post,10,true);
//     	curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
//     	$output = curl_exec($this->ch);
//     	//        CVarDumper::dump($output,10,true);die;
    
    
//     	$obj = json_decode($output);

//    	"curl -u andrew.lunny@nitobi.com -X PUT -d 'data={"pull":"true"}' https://build.phonegap.com/api/v1/apps/8"

//     	$command11  = "curl -F file=@$file ";
//     	$command11 .= "-u $this->name:$this->password ";
//     	$command11 .= " -F 'data={\"title\":\"$title\",\"package\":\"build.soft.biz\",\"version\":\"0.1.0\",\"create_method\":\"$createMethod\"}' ";
//     	$command11 .= " https://build.phonegap.com/api/v1/apps ";
    	
    	if (isset($keys)) {
    	  		
    	 	$post	= json_encode(array( "pull"=>"true","keys" => $keys));
    	   		    	  		
    	  	$command11  = "curl -u $this->name:$this->password -X PUT -d 'data=$post' https://build.phonegap.com/api/v1/apps/".$id;
    	  	//	echo "<br>".$command11."<br>"; die;
    	}else{
    		
    		$command11  = "curl -u $this->name:$this->password -X PUT -d 'data={\"pull\":\"true\"}' https://build.phonegap.com/api/v1/apps/".$id;
    		//echo $command11."<br>"; die;
    	}
    	echo $command11."<br>";
    	$output = exec($command11);
    
    	//print_r($output); die;
    	$obj = json_decode($output);
    	
    	if (is_object($obj) && isset($obj->id)) {
    		return $obj->id;
    	} else {
    		CVarDumper::dump($post, 10, true);
    		CVarDumper::dump($output, 10, true);
    		
    		return false;
    	}
    }
    
    public function uploadAppKey($file, $title,$password, $createMethod, $keys=null) {
    	 
    	$command11  = "curl ";
    	$command11 .= "-u $this->name:$this->password ";
    	$command11 .= " -F cert=@$file[p12] ";
    	$command11 .= " -F profile=@$file[provision] ";
    	$command11 .= " -F 'data={\"title\":\"$title\",\"password\":\"$password\"}' ";
    	$command11 .= " https://build.phonegap.com/api/v1/keys/ios ";
    	
    	
    	//echo $command11; die;
    	$output = exec($command11);
    	//print_r($amrit);
    	 
    	$obj = json_decode($output);
    	 
    	if (is_object($obj) && isset($obj->id)) {
    		return $obj->id;
    	} else {
    		//CVarDumper::dump($post, 10, true);
    		CVarDumper::dump($output, 10, true);
    		
    		return false;
    	}
    	 
    	 
    }
    

}
