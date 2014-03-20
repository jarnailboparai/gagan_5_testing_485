<?php

Yii::import('application.vendors.*');
require_once 'phonagap.php';

class AppleprofileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','appkeycreate','certlist','certcreate','certview','certupdate'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AppleProfile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AppleProfile']))
		{

			$model->attributes=$_POST['AppleProfile'];
			$model->p12_file = CUploadedFile::getInstance($model,'p12_file');
			$model->store_provisioning_profile = CUploadedFile::getInstance($model,'store_provisioning_profile');
			if($model->save())
			{
				$model->p12_file->saveAs(Yii::getPathOfAlias('webroot') . "/apple/p12/" . $model->user_id.'_'.$model->p12_file);
				$model->store_provisioning_profile->saveAs(Yii::getPathOfAlias('webroot') . "/apple/provision/" . $model->user_id.'_'.$model->store_provisioning_profile);
				// redirect to success page
				$this->redirect(array("appkeycreate"));
				//$this->redirect(array('view','id'=>$model->id));
			}
			

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		//echo "<pre>"; print_r($model->attributes); die;
		
		$ss = $model ;

		if(isset($_POST['AppleProfile']))
		{
			//$model->attributes=$_POST['AppleProfile'];
			
			$model->apple_email = $_POST['AppleProfile']['apple_email'];
			$model->phone_gap_key_title = $_POST['AppleProfile']['phone_gap_key_title'];
			$model->apple_p12_password = $_POST['AppleProfile']['apple_p12_password'];
			
			//$model->apple_email = $_POST['AppleProfile']['apple_email'];
			
			
			//if()
			$p12_file = CUploadedFile::getInstance($model,'p12_file');
			$store_provisioning_profile = CUploadedFile::getInstance($model,'store_provisioning_profile');
			
		//	echo "<pre>";
		//	print_r($p12_file);
		//	print_r($store_provisioning_profile);
			
			if(!empty($p12_file))
				$model->p12_file = $p12_file  ;
			
			
			if(!empty($store_provisioning_profile))
				$model->store_provisioning_profile = $store_provisioning_profile;
			
			
			if($model->save())
			{
				if(!empty($p12_file))
					$model->p12_file->saveAs(Yii::getPathOfAlias('webroot') . "/apple/p12/" . $model->user_id.'_'.$model->p12_file);
				
				if(!empty($store_provisioning_profile))
					$model->store_provisioning_profile->saveAs(Yii::getPathOfAlias('webroot') . "/apple/provision/" . $model->user_id.'_'.$model->store_provisioning_profile);
				// redirect to success page
				
				$this->redirect(array("appkeycreate"));
				//$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AppleProfile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AppleProfile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AppleProfile']))
			$model->attributes=$_GET['AppleProfile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=AppleProfile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='apple-profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAppkeycreate()
	{
		$ios_profile_model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		print_r($ios_profile_model->attributes); 
		$file = array();
		$file['p12'] = Yii::getPathOfAlias('webroot') . "/apple/p12/" .Yii::app()->user->id.'_'.$ios_profile_model->attributes['p12_file'];
		$file['provision'] = Yii::getPathOfAlias('webroot') . "/apple/provision/" .Yii::app()->user->id.'_'.$ios_profile_model->attributes['store_provisioning_profile'];
		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
		
		$id = $phone->uploadAppKey($file, $ios_profile_model->attributes['phone_gap_key_title'],$ios_profile_model->attributes['apple_p12_password'], 'remote_repo',null);
		
		$ios_profile_model->phonegap_id = $id;
		
		$ios_profile_model->update();
		
		$this->redirect(array("applicationnew/dashboard"));
		die("asdf");
	}
	
	public function actionCertlist()
	{
		$dataProvider=
		
		/* new CActiveDataProvider('Post', array(
				'criteria'=>array(
						'condition'=>'status=1',
						'order'=>'create_time DESC',
						'with'=>array('author'),
				),
				'countCriteria'=>array(
						'condition'=>'status=1',
						// 'order' and 'with' clauses have no meaning for the count query
				),
				'pagination'=>array(
						'pageSize'=>20,
				),
		));
 */		
		$us = "t.user_id=".Yii::app()->user->id;
		
		$dataProvider=new CActiveDataProvider('AppleProfile', array(
				'criteria'=>array(
						'condition'=>$us,
						//'order'=>'create_time DESC',
						'with'=>array('applicationprofile'),
				),

				'pagination'=>array(
						'pageSize'=>20,
				),
		));
		$this->render('certindex',array(
				'dataProvider'=>$dataProvider,
		));
	
		//$this->redirect(array("applicationnew/dashboard"));
		
	}
	
	public function actionCertcreate()
	{
		$model=new AppleProfile;
		
		$dropdown = Application::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
	
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['AppleProfile']))
		{
	
			$model->attributes=$_POST['AppleProfile'];
			$model->p12_file = CUploadedFile::getInstance($model,'p12_file');
			$model->store_provisioning_profile = CUploadedFile::getInstance($model,'store_provisioning_profile');
			if($model->save())
			{
				$model->p12_file->saveAs(Yii::getPathOfAlias('webroot') . "/apple/p12/" . $model->user_id.'_'.$model->application_id.'_'.$model->p12_file);
				$model->store_provisioning_profile->saveAs(Yii::getPathOfAlias('webroot') . "/apple/provision/" .  $model->user_id.'_'.$model->application_id.'_'.$model->store_provisioning_profile);
				// redirect to success page
				$this->redirect(array("certlist"));
				//$this->redirect(array('view','id'=>$model->id));
			}else{
				
			}
				
	
		}
		
		$this->render('certcreate',array(
				'model'=>$model,
				'dropdown'=>$dropdown,
		));
	}
	
	public function actionCertview($id)
	{
		$this->render('certview',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCertupdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		//echo "<pre>"; print_r($model->attributes); die;
	
		$ss = $model ;
	
		if(isset($_POST['AppleProfile']))
		{
			//$model->attributes=$_POST['AppleProfile'];
				
			$model->apple_email 		= $_POST['AppleProfile']['apple_email'];
			$model->phone_gap_key_title = $_POST['AppleProfile']['phone_gap_key_title'];
			$model->apple_p12_password 	= $_POST['AppleProfile']['apple_p12_password'];
			$model->application_id 		= $_POST['AppleProfile']['application_id'];
				
			//$model->apple_email = $_POST['AppleProfile']['apple_email'];
				
				
			//if()
			$p12_file = CUploadedFile::getInstance($model,'p12_file');
			$store_provisioning_profile = CUploadedFile::getInstance($model,'store_provisioning_profile');
				
			//	echo "<pre>";
			//	print_r($p12_file);
			//	print_r($store_provisioning_profile);
				
			if(!empty($p12_file))
				$model->p12_file = $p12_file  ;
				
				
			if(!empty($store_provisioning_profile))
				$model->store_provisioning_profile = $store_provisioning_profile;
				
				
			if($model->save())
			{
				if(!empty($p12_file))
					$model->p12_file->saveAs(Yii::getPathOfAlias('webroot') . "/apple/p12/" . $model->user_id.'_'.$model->application_id.'_'.$model->p12_file);
	
				if(!empty($store_provisioning_profile))
					$model->store_provisioning_profile->saveAs(Yii::getPathOfAlias('webroot') . "/apple/provision/" .  $model->user_id.'_'.$model->application_id.'_'.$model->store_provisioning_profile);
				// redirect to success page
	
				$this->redirect(array("certlist"));
			}
		}
		
		$dropdown = Application::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
	
		$this->render('certupdate',array(
				'model'=>$model,
				'dropdown'=>$dropdown,
		));
	}
	
}
