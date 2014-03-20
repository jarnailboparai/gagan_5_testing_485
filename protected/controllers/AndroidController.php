<?php

Yii::import('application.vendors.*');
require_once 'phonagap.php';

class AndroidController extends Controller {

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
    					'actions'=>array('index','view','createKeystore','newdata'),
    					'users'=>array('*'),
    			),
    			array('allow', // allow authenticated user to perform 'create' and 'update' actions
    					'actions'=>array('create','update','appkeycreate','applelist','certificatecreate','orderlist'),
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

    public function actionDeveloperDetails() {
        $model = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if ($model == null)
            $model = new AndroidProfile;
        if (isset($_POST['AndroidProfile'])) {
            $model->attributes = $_POST['AndroidProfile'];
//            $model->android_file_keystore = CUploadedFile::getInstance($model, 'android_file_keystore');
            $model->user_id = Yii::app()->user->id;





            if ($model->save()) {
                $model->android_file_keystore = $this->genratekeyandroid($model->android_keystore_password);
                $model->phonegap_id = $this->uploadKey($model);
                $model->save();
//                $model->android_file_keystore->saveAs('certificate_files/' . $model->android_file_keystore);
                $this->redirect(array('/ios/view'));
            }
        }

        $this->render('developer_details', array(
            'model' => $model,
        ));
    }



    public function genratekeyandroid($key_password) {
        $user_id = Yii::app()->user->id;
        $keystore_file = "ks_" . $user_id . ".keystore";
        $base = Yii::getPathOfAlias("webroot") . "/android_keys";
        shell_exec("keytool -genkey -v -keystore $base/$keystore_file -alias $keystore_file -keyalg RSA -validity 10000 -keypass $key_password -storepass $key_password -dname \"cn=Noman iqbal\"");
        return $keystore_file;
    }

    public function uploadKey($model) {
        $phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
        $res = $phone->setKeysAndroid($model->android_file_keystore, $model->android_keystore_password, $model->android_file_keystore, $model->android_keystore_password, Yii::getPathOfAlias("webroot") . '/android_keys/' . $model->android_file_keystore);
        if (property_exists($res, "id")) {
            return $res->id;
        }
    }
    
    public function actionNewdata($application_id)
    {
    	//return $keystore_file;
    	$temp =  false;
    	$model = AndroidProfile::model()->with('application')->findByAttributes(array('user_id' => Yii::app()->user->id,'application_id'=>$application_id));
    	
    	if(count($model)){
    	
    		//die("asdf");
    		$this->createkeyphonegap($model);
    		$temp =  true;
	    	
    	}else{
    		
    		$model = new AndroidProfile;
    		
    		$length = 10;
    		$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
    		shuffle($chars);
    		$key_password = implode(array_slice($chars, 0, $length));
    		
    		$user_id = Yii::app()->user->id;
    		$keystore_file = "ks_" . $user_id .'_'. $application_id .".keystore";
    		$base = Yii::getPathOfAlias("webroot") . "/android_keys";
    		shell_exec("keytool -genkey -v -keystore $base/$keystore_file -alias $keystore_file -keyalg RSA -validity 10000 -keypass $key_password -storepass $key_password -dname \"cn=Noman iqbal\"");
    		
    		$model->user_id = $user_id;
    		$model->application_id = $application_id;
    		$model->android_keystore_password = $key_password;
    		$model->android_file_keystore = $keystore_file;
    		
    		$model->android_keystore_name = 'appgorilla_'. $user_id .'_'. $application_id ;
    		
    		
    		if($model->save()){
    			
    			$this->createkeyphonegap($model);
    			$temp =  true;
    		}
    		
    	}
    	
    	return $temp;
    	
    	//$this->redirect(array('applicationnew/dashboard'));
    	//echo "done"; die;
    }
    
    private function createkeyphonegap($model)
    {
    	$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
    	//print_r($phone);
    	$res = $phone->setKeysAndroid($model->android_file_keystore, $model->android_keystore_password, $model->android_file_keystore, $model->android_keystore_password, Yii::getPathOfAlias("webroot") . '/android_keys/' . $model->android_file_keystore);
    	//print_r($res);
    	if($res)
    	{
    		$model->phonegap_id = $res->id;
    		$model->update();
    		return true;
    	}else{
    			return false;
    		}
    	
    		
    }

}
