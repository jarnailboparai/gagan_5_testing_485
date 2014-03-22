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
						'actions'=>array('create','update','appkeycreate','applelist','certificatecreate','orderlist','changeappbg','videodetail','Editvideodetail','videodetailgallery','image'),
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
	
	
	public function actionChangeappbg()
	{	echo print_r($_FILES);
		$tempFile   = $_FILES['Filedata']['tmp_name'];
		$target = Yii::getPathOfAlias('webroot').'/appTheme/wooden/common/images/theme_background.jpg';
		move_uploaded_file($tempFile, $target);
		
		/*
		$images = CUploadedFile::getInstancesByName('files');
		if (isset($images) && count($images) > 0) {
			foreach ($images as $image => $pic) {
				echo $pic->name.'<br />';
				$pic->saveAs(Yii::getPathOfAlias('webroot').'/appTheme/wooden/common/images/theme_background.jpg');
			}
		}
		$this->redirect(array('/applicationnew/listfeatures'));
	*/
	}
	
	
	public function actionVideodetail($module_id,$layout)
	{	
		$model=new VideoFiles;
		$model = VideoFiles::model()->findByAttributes(array('id'=>$module_id));
		
		//die;
		//echo "<pre>"; print_r($model); die;
		
		$this->layout = false;
		$this->render('/videofiles/_videodetail',array('model'=>$model));
		
	}
	
	public function actionVideodetailgallery($video_id=null,$module_id=null,$layout=null)
	{
		$model=new VideoFiles;
		$model = VideoFiles::model()->findByAttributes(array('id'=>$video_id));
	
		//die;
		//echo "<pre>"; print_r($model); die;
		if($layout)
			$this->layout = false;
		$this->render('/videofiles/_videodetailgallery',array('model'=>$model,'module_id'=>$module_id));
	
	}
	
	public function actioneditvideodetail()
	{	
		if(isset($_POST['Videodetail']))
		{
			
			$model = VideoFiles::model()->findByAttributes(array('id'=>$_POST['Videodetail']['id']));
			if(isset($_POST['Videodetail']['name']))	
			{
			$model->title = $_POST['Videodetail']['name'];
			}
			if(isset($_POST['Videodetail']['description']))
			{
				$model->description = $_POST['Videodetail']['description'];
			}
			if($model->save()){
				echo json_encode(array('success'=>1));
				die();
			}else{
				echo json_encode(array('success'=>0,'error'=>$model->errors));
				die();
			}
		}
	
	
	}
	
	public function actionImage()
	{	echo "sdsd"; die;
		
		$this->render('/videofiles/_videodetailgallery',array('model'=>$model,'module_id'=>$module_id));
	
	}
	
}
