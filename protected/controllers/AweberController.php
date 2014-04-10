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
						'actions'=>array('index','addadmob','aweber','appverify','addusertolist'),
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
		
		$model = Aweberusers::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		
		$account = null;
		
		if(count($model))
		{
			//list($accessToken, $accessTokenSecret) = array($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
			$account = $aweber->getAccount($model->token, $model->tokensecret);

			$modelList = Aweberlisting::model()->countByAttributes(array('aweberapplication_id'=>$model->awerberapplication));
			
			if($modelList)
			{
				
			}
			
			$model->update();
		
		}else{
			
			$model = new Aweberusers;
			
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
			
			//setcookie('accessToken', $accessToken);
			//setcookie('accessTokenSecret', $accessTokenSecret);
			//header('Location: '.$_COOKIE['callbackUrl']);
			//exit();
		

			//list($accessToken, $accessTokenSecret) = array($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
			
			$model->token = $accessToken;
			$model->tokensecret = $accessTokenSecret;
			$model->user_id =  Yii::app()->user->id;
			$model->created = date( 'Y-m-d H:i:s', time() );
			if($model->save())
			{
				$account = $aweber->getAccount($model->token, $model->tokensecret);
				$model->awerberapplication = $account->data['id'];
				$model->save();
			}
		}
			
			
		//echo "<pre>"; print_r($_COOKIE); die;

		$aweber->adapter->debug = false; 

		//$account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
		//echo "<pre>"; print_r($account);
		//die;
		
		$this->getlist($account);
		
		$this->render('appverify',array('account'=>$account));
	}
	
	public function actionGetlist()
	{
		
	}
	
	private function getlist($account)
	{
		
		if(count($account->lists))
		{
			
			foreach($account->lists as $offset => $list) 
			{
				//echo $list->name;
				//echo  $list->id; 
				
				$model = new Aweberlisting;
				
				$model->aweberapplication_id = $account->data['id'];
				$model->list_id = $list->id ;
				$model->name = $list->name ;
				$model->created = date( 'Y-m-d H:i:s', time() );
				
				//$this->getcampaigns($list);
				
				$model->save();
			}
			return true;
		}else{
			
			return false;
		}
		
		
	}
	
	private function getcampaigns($list)
	{
		foreach($list->campaigns as $campaign) {
			if ($campaign->type == 'broadcast_campaign') {
		
		
				echo $campaign->subject;
				echo date('F j, Y h:iA', strtotime($campaign->sent_at));
				 
				echo $campaign->total_opens;
				echo $campaign->total_sent;
				echo $campaign->total_clicks;
		
				 
			}
		}
	}
	
	public function actionAddusertolist()
	{
		Yii::import('ext.AWeber.*');
			
		$consumerKey    = "Akjoa6ncuk55rXLlof4PWCIc";
		$consumerSecret = "PWZyuAiR1KsUtFgh4MO48RphSaaglImljJ56rGu5";
		
		$aweber = new AWeberAPI($consumerKey, $consumerSecret);
		
		$aweberid = 846164;
		$listid	  = 3316206;
		$email	  = "amritpal.singh@softobiz.com";
		$name	  = "Amritpal Sinagh";
		
		$attendee_info['email'] = $email;
		$attendee_info['name']	= $name;
		
		$model = Aweberusers::model()->findByAttributes(array('awerberapplication' => $aweberid));
		
		if(count($model))
		{
			$account = $aweber->getAccount($model->token, $model->tokensecret);
			$this->addAttendeeToRegList($account,$attendee_info,$listid, $model);
		}
		
		
		die("List add to work");
		 
	}
	
	private function addAttendeeToRegList($account,$attendee_info=array('name'=>'','email'=>''),$list_id=0,$model){
		
		try{
			$listURL  		= "/accounts/{$model->awerberapplication}/lists/{$list_id}";
			$list 	  		= $account->loadFromUrl($listURL);
			
			return $new_subscriber = $list->subscribers->create(	
													array(	'email' =>$attendee_info['email'],
															'name' => $attendee_info['name']
														)
										);
			
			if($new_subscriber) return true; else return false;
		
		}catch(AWeberAPIException $exc) {
			return $exc->message;
			return false;
		}
	}
	
	
}
