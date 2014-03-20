<?php

class TutorialController extends Controller
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
	
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLive()
	{
		$this->render('live');
	}

	// Uncomment the following methods and override them if needed
	/*
	

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function actionOrderlist()
	{
		//echo "<pre>"; print_r($_POST); die;
		
		if(isset($_POST['module']))
		{
			$temp = 1;
			foreach($_POST['module'] as $data)
			{
				$model =  Module::model()->findByPk($data);
				
				//print_r($model->attributes);
				$model->module_order = $temp;
				
				$temp++;
				
				$model->update();
			}
				
		}else{
			
		}
	}
}
