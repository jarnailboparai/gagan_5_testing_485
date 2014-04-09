<?php
require_once('aweber_api/aweber.php');
//require_once('aweber_api/aweber_api.php');
// Replace with the keys of your application
// NEVER SHARE OR DISTRIBUTE YOUR APPLICATIONS'S KEYS!
// 		$consumerKey    = "Akjoa6ncuk55rXLlof4PWCIc";
// 		$consumerSecret = "PWZyuAiR1KsUtFgh4MO48RphSaaglImljJ56rGu5";

// $aweber = new AWeberAPI($consumerKey, $consumerSecret);

// if (empty($_COOKIE['accessToken'])) {
//     if (empty($_GET['oauth_token'])) {
//         $callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//         list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
//         setcookie('requestTokenSecret', $requestTokenSecret);
//         setcookie('callbackUrl', $callbackUrl);
//         header("Location: {$aweber->getAuthorizeUrl()}");
//         exit();
//     }

//     $aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
//     $aweber->user->requestToken = $_GET['oauth_token'];
//     $aweber->user->verifier = $_GET['oauth_verifier'];
//     list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
//     setcookie('accessToken', $accessToken);
//     setcookie('accessTokenSecret', $accessTokenSecret);
//     header('Location: '.$_COOKIE['callbackUrl']);
//     exit();
// }

// # set this to true to view the actual api request and response
// $aweber->adapter->debug = false;

// $account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);

// return $account;


class Demotest
{
	public function  __construct()
	{
		$consumerKey    = "Akjoa6ncuk55rXLlof4PWCIc";
		$consumerSecret = "PWZyuAiR1KsUtFgh4MO48RphSaaglImljJ56rGu5";
		
		$aweber = new AWeberAPI($consumerKey, $consumerSecret);
		
		if (empty($_COOKIE['accessToken'])) {
			if (empty($_GET['oauth_token'])) {
				$callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
				setcookie('requestTokenSecret', $requestTokenSecret);
				setcookie('callbackUrl', $callbackUrl);
				header("Location: {$aweber->getAuthorizeUrl()}");
				exit();
			}
		
			$aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
			$aweber->user->requestToken = $_GET['oauth_token'];
			$aweber->user->verifier = $_GET['oauth_verifier'];
			list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
			setcookie('accessToken', $accessToken);
			setcookie('accessTokenSecret', $accessTokenSecret);
			header('Location: '.$_COOKIE['callbackUrl']);
			exit();
		}
		
		# set this to true to view the actual api request and response
		$aweber->adapter->debug = false;
		
		$account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
		
		return $account;
	}
}

?>

