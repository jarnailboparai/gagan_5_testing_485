<?php

class MacmachineController extends Controller
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
						'actions'=>array('index','addadmob','aweber'),
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
	
	public function actionAddadmob()
	{
					
	}
	
	public function actionAweber()
	{
		echo json_encode(array('sdf'=>'asdf',99=>'asdf','dd'=>$_POST)); die;
		//echo json_encode(array('sdf'=>'asdf',99=>'asdf')); die;
	}
}
