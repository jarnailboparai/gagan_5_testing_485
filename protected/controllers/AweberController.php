<?php

require_once(__DIR__.'/../extensions/AWeber/aweber_api/aweber.php');

class AweberController extends Controller
{
	public $layout='//layouts/column3';
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index','addadmob','aweber','appverify'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionAppverify()
	{
		Yii::import('ext.AWeber.*');
			
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
		

		$aweber->adapter->debug = true; 

		$account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
		
		$this->render('appverify',array('account'=>$account));
	}
	
	public function actionGetlist()
	{
		
	}
	
}
