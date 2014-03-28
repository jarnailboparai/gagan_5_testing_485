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
						'actions'=>array('create','update','appkeycreate','applelist','certificatecreate','orderlist','changeappbg','videodetail','Editvideodetail','videodetailgallery','image','imagebackground','uploadbackground','image_resize','uploadimage_background','BuildApp'),
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
	{	
		$model=new MediaFiles;
		$this->render('/mediafiles/_backgroung',array('model'=>$model));
	}
	
	public function actionImagebackground($layout=null,$module_id=null)
	{
	
		//$dataProvider=new CActiveDataProvider('MediaFiles');
	
	
		if(isset($layout)){
			$this->layout = false;
		}
	
		$selected = array();
		if(isset($module_id)) {
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$module_id));
				
			foreach ($dataSelectedImages as $image){
	
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
				//print_r($image->filemedia->attributes['id']);
			}
				
		}
		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
	
		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
	
		$this->render('/mediafiles/_backgroundimagelist',array(
				'dataProvider'=>$dataProvider,
				'fileUrl'=>$fileUrl,
				'module_id'=>$module_id,
				'selected' =>$selected
		));
	
	
	}
	
	
	public function actionUploadbackground()
	{	
		
		if($_POST['app_id'])
		{
			$app_id = Yii::app()->user->getState('app_id');
			$modeldd = new ThemeSettingBackground();
				
			$modeldd->deleteAllByAttributes(array('app_id'=>$app_id));
				
			if(isset($_POST['selected']))
			{
				
				foreach($_POST['selected'] as $select )
				{
					$model = new ThemeSettingBackground();
				//	$model->app_id = $_POST['app_id'];
					$model->app_id = $app_id;
					$model->media_files_id = $select;
					if($model->save())
					{
						$this->actionImage_resize($select,$app_id);
					}else{
						//CVarDumper::dump($model->errors,10,true);
					}
				}
			}else{
				echo "stop"; die;
			}
			
			die;
		}
	}
	
	
	
	public function actionImage_resize($id=null,$appid=null)
	{
		
		$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
		$sourse = $dest_path;
		$dest_path .= "background/ycc_".$appid."/" ;
		
		if (!file_exists($dest_path))
			mkdir($dest_path,0777,true);
	
		Yii::import('ext.PHPImageWorkshop.*');

		$data = MediaFiles::model()->findByPk($id);
		$path = $sourse.$data->filename;
	
		$layoutLayer = ImageWorkshop::initFromPath($path);
	
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
	
		array(256,256,false,0,0,'MM');
	
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
	
		$layoutLayer->save($dest_path,"theme_background".".".$data->extension, true, null, 95);
	
	
	}
	
	
	public function actionUploadimage_background($layout=null,$module_id=null)
	{
		if(isset($layout)){
			$this->layout = false;
		}
		
		$selected = array();
		if(isset($module_id)) {
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$module_id));
				
			foreach ($dataSelectedImages as $image){
		
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
				//print_r($image->filemedia->attributes['id']);
			}
				
		}
		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		
		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
		
		$this->render('/mediafiles/nameuploadimage_background',array(
				'dataProvider'=>$dataProvider,
				'fileUrl'=>$fileUrl,
				'module_id'=>$module_id,
				'selected' =>$selected
		));
	}
	
	
	
	
	public function actionbuildApp($id=541343)
	{	
		$data = Applink::model()->findByAttributes(array("application_id"=>$id));
		$status = $data->flag;
		 
		if($status==1)
		{
			$this->redirect(array('/applicationnew/buildAppMy','id'=>$id));
		}
		else
		{
			$data->flag =1;
			$data->update();
			$this->redirect(array('/applicationnew/BuildPhoneGapAppMy','id'=>$id));
		}
	}
	
	
}
