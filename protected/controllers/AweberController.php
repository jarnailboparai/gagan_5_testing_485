<?php


require_once(__DIR__.'/../extensions/AWeber/aweber_api/aweber.php');

class AweberController extends Controller
{
	//Test key
// 	public  $consumerKey    = "Akjoa6ncuk55rXLlof4PWCIc";
// 	public 	$consumerSecret = "PWZyuAiR1KsUtFgh4MO48RphSaaglImljJ56rGu5";
	
	
	public  $consumerKey    = "Ak3AIoZZWeabgC23Sl158dpU";
	public 	$consumerSecret = "ZL6edaKekQSv3FyVRFDWjFJgaMo0wH0VsNvh3tnc";
	
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
						'actions'=>array('index','addadmob','aweber','appverify','addusertolist','apiintegration'),
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
		//print_r($_SERVER);
		$modelList = array();
		$data = array();
		$model = Aweberusers::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		
		if(count($model))
		{
			$modelList = Aweberlisting::model()->countByAttributes(array('aweberapplication_id'=>$model->awerberapplication));
			$data = CHtml::listData(Aweberlisting::model()->findAll(array('condition'=>"aweberapplication_id=$model->awerberapplication")), 'list_id', 'name');
		}
		
		$this->render('index',
				array( 	'model'=>$model,
						'modelList'=>$modelList,
						'data'=>$data
						));
	}
	
	public function actionAppverify()
	{
	//	try{
		Yii::import('ext.AWeber.*');
			
//  	$consumerKey    = "Akjoa6ncuk55rXLlof4PWCIc";
// 		$consumerSecret = "PWZyuAiR1KsUtFgh4MO48RphSaaglImljJ56rGu5";
		
		$aweber = new AWeberAPI($this->consumerKey, $this->consumerSecret);
		
		$model = Aweberusers::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		
		$account = null;
		
		if(count($model))
		{
			//list($accessToken, $accessTokenSecret) = array($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
			$account = $aweber->getAccount($model->token, $model->tokensecret);

			//$modelList = Aweberlisting::model()->countByAttributes(array('aweberapplication_id'=>$model->awerberapplication));
			
			$this->getlist($account);
			
			$model->update();
		
		}else{
			
			$model = new Aweberusers;
			
			if (empty($_GET['oauth_token'])) {
				$callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				//$data = $aweber->getRequestToken($callbackUrl); 
				
				//echo "<pre>"; print_r($data); die;
				list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
			
				//echo $requestToken; die;
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
				
				$this->getlist($account);
			}
		}
			
		$aweber->adapter->debug = false; 

	//	}catch(Exception $e)
	//	{
	//		Yii::app()->user->setFlash('success', "Error Please Try After Sometime!");
	//	}
		$this->redirect(array('index'));
		
	}
	
	public function actionGetlist()
	{
		
	}
	
	private function getlist($account)
	{
		
		if(count($account->lists))
		{
			Aweberlisting::model()->deleteAllByAttributes(array('aweberapplication_id'=>$account->data['id']));
			foreach($account->lists as $offset => $list) 
			{

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

		//echo "<pre>"; print_r($_POST); die;
		if(isset($_POST['aweberapp_id']))
		{
			
			Yii::import('ext.AWeber.*');
				
			$aweber = new AWeberAPI($this->consumerKey, $this->consumerSecret);
			
			$aweberid = $_POST['aweberapp_id'];
			$listid	  = $_POST['list_id'];
			$email	  = $_POST['email'];
			$name	  = $_POST['name'];
				
			
			$attendee_info['email'] = $email;
			$attendee_info['name']	= $name;
			
			$model = Aweberusers::model()->findByAttributes(array('awerberapplication' => $aweberid));
			
			if(count($model))
			{
				$lead_model = new Lead();
				$lead_model->lead_data($_POST);
				$account = $aweber->getAccount($model->token, $model->tokensecret);
				$dd = $this->addAttendeeToRegList($account,$attendee_info,$listid, $model);
				if($dd)
					echo json_encode(array('success'=>1,'message'=>'Successfully done'));
				else
					echo json_encode(array('success'=>0,'error'=>'Some issues at AWeber end please try later'));
			}
			else
			{
				$lead_model = new Lead();
				$lead_model->lead_data($_POST);
				echo json_encode(array('success'=>1,'message'=>'Successfully done'));
			}
		}else{
			
			echo json_encode(array('success'=>0,'error'=>'Please post proper data'));
		}
		
		die();
		 
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
	
	public function actionApiintegration()
	{
		$this->render("intergration");
	}
}
