<?php

class MediafilesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	//public $layout=false;

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
// 	public function accessRules()
// 	{
// 		return array(
// 			array('allow',  // allow all users to perform 'index' and 'view' actions
// 				'actions'=>array('index','view','indexlist'),
// 				'users'=>array('*'),
// 			),
// 			array('allow', // allow authenticated user to perform 'create' and 'update' actions
// 				'actions'=>array('create','update'),
// 				'users'=>array('@'),
// 			),
// 			array('allow', // allow admin user to perform 'admin' and 'delete' actions
// 				'actions'=>array('admin','delete','indexlistthumb','indexlist'),
// 				'users'=>array('admin'),
// 			),
// 			array('deny',  // deny all users
// 				'users'=>array('*'),
// 			),
// 		);
// 	}
	
// 	public function allowedActions() 
// 	{
// 		return 'admin,delete,indexlistthumb,indexlist';
// 	}

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
		$model=new MediaFiles;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MediaFiles']))
		{
			$model->attributes=$_POST['MediaFiles'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['MediaFiles']))
		{
			$model->attributes=$_POST['MediaFiles'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionIndex($layout=null,$module_id=null)
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
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'fileUrl'=>$fileUrl,
			'module_id'=>$module_id,
			'selected' =>$selected
		));
		
		
	}
    public function actionIndex_appicon($layout=null,$module_id=null,$app_icon_new=null)
	{
		   if(isset($layout)){
			$this->layout = false;
		}
		
		/*$selected = array();
		if(isset($module_id)) {
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$module_id));
			
			foreach ($dataSelectedImages as $image){
				
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
				//print_r($image->filemedia->attributes['id']);
			}
			
		}*/
		//$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		
		//$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/app_icon/';
		if(isset($app_icon_new) && ($app_icon_new == 1))
		{
			$this->render('//applicationnew/_app_icon_list',array( ));
		}
		else{
			  $this->render('_iconlist',array(/*
				  'dataProvider'=>$dataProvider,
				  'fileUrl'=>$fileUrl,
				  'module_id'=>$module_id,
				  'selected' =>$selected*/
			  ));
		}
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$user_id = Yii::app()->user->id;
		$model=new MediaFiles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MediaFiles']))
			$model->attributes=$_GET['MediaFiles'];

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
		$model=MediaFiles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='media-files-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionUploadfile()
	{
		$this->layout = false;
		if(isset($_POST['timestamp'])){

		$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
			if (!file_exists($dest_path))
				mkdir($dest_path,0777, true);
			
			$uploadDir = $dest_path;
			
				$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
				
				$verifyToken = md5('unique_salt' . $_POST['timestamp']);
				
				if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
					$tempFile   = $_FILES['Filedata']['tmp_name'];

					// Validate the filetype
					$fileParts = pathinfo($_FILES['Filedata']['name']);
					
					$targetFile = $uploadDir . Yii::app()->user->getState('username') .'_'. time() .'.'. strtolower($fileParts['extension']) ;
					
					if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
				
						// Save the file
						if(move_uploaded_file($tempFile, $targetFile))
						{
							
							$this->thumbnail($targetFile);
							
							$data['MediaFiles']['user_id'] 			= 	Yii::app()->user->id;
							$data['MediaFiles']['type']				=	$_FILES['Filedata']['type'];
							$data['MediaFiles']['filename'] 		= 	basename($targetFile);
							$data['MediaFiles']['original_name'] 	= 	$fileParts['filename'];
							$data['MediaFiles']['size']				=   $_FILES['Filedata']['size'];
							$data['MediaFiles']['extension']		=   $fileParts['extension'];
							$data['MediaFiles']['created']			=   date('Y-m-d',time());
							$data['MediaFiles']['updated']			=   date('Y-m-d',time());
							
							$this->createMedia($data);
							
							
						}
						//echo 1;
				
					} else {
				
						// The file type wasn't allowed
						echo 'Invalid file type.';
				
					}
					
				die;
			}
		}
		
		$this->render('uploadfile');
	}
	
	public function actionCheckexists()
	{

		$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->getState('id').'/';
		
		if (file_exists($dest_path. '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}
		
		die;
	}
	
	private function thumbnail($path)
	{
		$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
		
		$dest_path .= 'thumb/' ;
		
		if (!file_exists($dest_path))
				mkdir($dest_path);
		
		Yii::import('ext.PHPImageWorkshop.*');
		
		$filnameArray = pathinfo($path);
		
		$layoutLayer = ImageWorkshop::initFromPath($path);
		
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
		array(256,256,false,0,0,'MM');
		
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
		$layoutLayer->save($dest_path,$filnameArray['filename'].'_256x256.jpg', true, null, 95);
		
		$layoutLayer128 = ImageWorkshop::initFromPath($path);

 		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
 		array(128,128,false,0,0,'MM');
		
 		$layoutLayer128->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
 		$layoutLayer128->save($dest_path,$filnameArray['filename'].'_128x128.jpg', true, null, 95);
		
		
	}
	
	private function app_icon($path)
	{
		$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
		
		$dest_path .= 'app_icon/' ;
		
		if (!file_exists($dest_path))
				mkdir($dest_path);
		
		Yii::import('ext.PHPImageWorkshop.*');
		
		$filnameArray = pathinfo($path);
		
		$layoutLayer = ImageWorkshop::initFromPath($path);
		
		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
		array(48,48,false,0,0,'MM');
		
		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
		$layoutLayer->save($dest_path,$filnameArray['filename'].'_48x48.png', true, null, 95);
		
		/*$layoutLayer128 = ImageWorkshop::initFromPath($path);

 		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =
		
 		array(128,128,false,0,0,'MM');
		
 		$layoutLayer128->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);
		
 		$layoutLayer128->save($dest_path,$filnameArray['filename'].'_128x128.jpg', true, null, 95);*/
		
		
	}
	
	public function actionSelecticons()
	{
		//print_r($_POST);	die;
		
		
		
		if($_POST['module_id'])
		{
		
			$modeldd = new SubModules();
			
			$modeldd->deleteAllByAttributes(array('module_id'=>$_POST['module_id']));
			
			if(isset($_POST['selected']))
			{
				foreach($_POST['selected'] as $select )
				{
					$model = new SubModules();
					$model->module_id = $_POST['module_id'];
					$model->media_files_id = $select;
					$model->activated = 'yes';
					$model->name = 'photo';
					if($model->save())
					{
						//echo "done";
					}else{
						//CVarDumper::dump($model->errors,10,true);
					}
				}
			}else{
				echo "stop"; die;
			}
			//echo json_encode($_POST);

			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$_POST['module_id']));
			
			echo $this->renderPartial('//mediafiles/_imagelist' ,array("dataProvider"=>$dataSelectedImages));
			
			die;
		}
	}
	
	private function createMedia($data)
	{
		$model=new MediaFiles;
		
		$dest_url = Yii::app()->baseUrl. '/mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
	
		if(isset($data['MediaFiles']))
		{
			//print_r($data['MediaFiles']);
			$model->attributes = $data['MediaFiles'];
			//print_r($model->attributes);
			if($model->save()){
				echo json_encode(array('image'=>$model->attributes,'url'=>$dest_url));
			}else{
				CVarDumper::dump($model->errors,10,true);
				die('failed');
			}
		}
	
	}
	
	public function actionSelectimages()
	{
		//print_r($_POST);	die;
		
		
		
		if($_POST['module_id'])
		{
		
			$modeldd = new SubModules();
			
			$modeldd->deleteAllByAttributes(array('module_id'=>$_POST['module_id']));
			
			if(isset($_POST['selected']))
			{
				foreach($_POST['selected'] as $select )
				{
					$model = new SubModules();
					$model->module_id = $_POST['module_id'];
					$model->media_files_id = $select;
					$model->activated = 'yes';
					$model->name = 'photo';
					if($model->save())
					{
						//echo "done";
					}else{
						//CVarDumper::dump($model->errors,10,true);
					}
				}
			}else{
				echo "stop"; die;
			}
			//echo json_encode($_POST);

			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$_POST['module_id']));
			
			echo $this->renderPartial('//mediafiles/_imagelist' ,array("dataProvider"=>$dataSelectedImages));
			
			die;
		}
	}
	
	public function actionImageList($layout=null,$module_id=null)
	{

// 		if(isset($layout)){
// 			$this->layout = true;
// 		}
		
		$selected = array();
		if(isset($module_id)) {
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$module_id));
				
			foreach ($dataSelectedImages as $image){
		
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
				
				//print_r($image->filemedia->attributes['id']);
			}
				
		}
		
		//die;
		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		
		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
		
		$this->render('indexlist',array(
				'dataProvider'=>$dataSelectedImages,
				'fileUrl'=>$fileUrl,
				'module_id'=>$module_id,
				'selected' =>$selected
		));
		
	}
	
	public function actionImagelistthumb($layout=null,$thumb=null,$select=null)
	{
	
		if(isset($layout)){
				$this->layout = true;
		}
	
		
		$selected = array();
		
		array_push($selected, $select);
		
		if(isset($thumb)) {
			$dataSelectedImages  = VideoFiles::model()->findAllByAttributes(array('id'=>$id));
	
			foreach ($dataSelectedImages as $image){
	
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
	
				//print_r($image->filemedia->attributes['id']);
			}
	
		}
	
		//die;
		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		
		
	
		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
	
		$this->render('imagelistthumb',array(
				'dataProvider'=>$dataProvider,
				'fileUrl'=>$fileUrl,
				'selected'=>$selected,
				
		));
	
	}
	
	public function actionNameedit()
	{
		if(isset($_POST['MediaFiles']))
		{
			//$model=new MediaFiles;
			$model = MediaFiles::model()->findByAttributes(array('id'=>$_POST['MediaFiles']['id']));
			//print_r($_POST['MediaFiles']);
			$model->original_name = $_POST['MediaFiles']['name'];
			//print_r($model->attributes);
			if($model->save()){
				//echo json_encode(array('image'=>$model->attributes,'url'=>$dest_url));
				echo json_encode(array('success'=>1));
				die();
			}else{
				//CVarDumper::dump($model->errors,10,true);
				echo json_encode(array('success'=>0,'error'=>$model->errors));
				die();
			}
		}
	}
	
	public function actionUploadImage($layout=null,$module_id=null)
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
		
		$this->render('nameuploadimage',array(
			'dataProvider'=>$dataProvider,
			'fileUrl'=>$fileUrl,
			'module_id'=>$module_id,
			'selected' =>$selected
		));
	}
	
	public function actionUploadIcon($layout=null,$module_id=null,$app_icon_new=null)
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
		
		//$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
		
		//$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/app_icon/';
		
		$this->render('nameuploadicon',array(
			/*'dataProvider'=>$dataProvider,
			'fileUrl'=>$fileUrl,*/
			'module_id'=>$module_id,
			'app_icon_new'=>$app_icon_new
			//'selected' =>$selected
		));
	}
	
	public function actionUploadfilenew()
	{
		$this->layout = false;
		if(isset($_POST)){
	
			print_r($_POST);
			//$session_data = explode('&',$_POST['images']);
			parse_str($_POST['images'],$session_data);
			//print_r($session_data);
			//die;
			$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
			if (!file_exists($dest_path))
				mkdir($dest_path,0777, true);
				
			$uploadDir = $dest_path;
				
			$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
	
			//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	
			//if ((!empty($_FILES) && $_POST['token'] == $verifyToken ) || 1) {
			echo "<pre>"; print_r($_FILES);
			if (!empty($_FILES)) {
				$keyee = str_replace(' ', '_', $_FILES['Filedata']['name']);
				$keyee = str_replace('.', '_', $keyee);
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
	
				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				
				mt_srand();
				$idimagenew = mt_rand(10000000, 99999999);
					
				$targetFile = $uploadDir . Yii::app()->user->getState('username') .'_'. time() . $idimagenew .'.'. strtolower($fileParts['extension']) ;
					
				if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
	
					// Save the file
					if(move_uploaded_file($tempFile, $targetFile))
					{
							
						$this->thumbnail($targetFile);
							
						$data['MediaFiles']['user_id'] 			= 	Yii::app()->user->id;
						$data['MediaFiles']['type']				=	$_FILES['Filedata']['type'];
						$data['MediaFiles']['filename'] 		= 	basename($targetFile);
						//$data['MediaFiles']['original_name'] 	= 	$fileParts['filename'];
						$data['MediaFiles']['original_name'] 	= 	$session_data['nameoriginal_'.$keyee];
						$data['MediaFiles']['size']				=   $_FILES['Filedata']['size'];
						$data['MediaFiles']['extension']		=   $fileParts['extension'];
						$data['MediaFiles']['created']			=   date('Y-m-d',time());
						$data['MediaFiles']['updated']			=   date('Y-m-d',time());
							
						$this->createMedia($data);
							
					}
	
				} else {
	
					echo 'Invalid file type.';
	
				}
					
				die;
			}
		}
	
		$this->render('uploadfile');
	}
	
	public function actionUploadiconnew($app_icon_new=null)
	{
		$this->layout = false;
		if(isset($_POST)){
	
			print_r($_POST);
			//$session_data = explode('&',$_POST['images']);
			parse_str($_POST['images'],$session_data);
			//print_r($session_data);
			//die;
			$dest_path = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
			if (!file_exists($dest_path))
				mkdir($dest_path,0777, true);
				
			$uploadDir = $dest_path;
			if(isset($app_icon_new) && ($app_icon_new == 1))
			{	
			$fileTypes = array('png'); // Allowed file extensions
			}
			else
			{
				//$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extension
				$fileTypes = array('png');
			}
			//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	
			//if ((!empty($_FILES) && $_POST['token'] == $verifyToken ) || 1) {
			echo "<pre>"; print_r($_FILES);
			if (!empty($_FILES)) {
				$keyee = str_replace(' ', '_', $_FILES['Filedata']['name']);
				$keyee = str_replace('.', '_', $keyee);
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
	
				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				
				mt_srand();
				$idimagenew = mt_rand(10000000, 99999999);
					
				$targetFile = $uploadDir . Yii::app()->user->getState('username') .'_'. time() . $idimagenew .'.'. strtolower($fileParts['extension']) ;
					
				if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
	
					// Save the file
					if(move_uploaded_file($tempFile, $targetFile))
					{
							
						$this->app_icon($targetFile);
							
						/*$data['MediaFiles']['user_id'] 			= 	Yii::app()->user->id;
						$data['MediaFiles']['type']				=	$_FILES['Filedata']['type'];
						$data['MediaFiles']['filename'] 		= 	basename($targetFile);
						//$data['MediaFiles']['original_name'] 	= 	$fileParts['filename'];
						$data['MediaFiles']['original_name'] 	= 	$session_data['nameoriginal_'.$keyee];
						$data['MediaFiles']['size']				=   $_FILES['Filedata']['size'];
						$data['MediaFiles']['extension']		=   $fileParts['extension'];
						$data['MediaFiles']['created']			=   date('Y-m-d',time());
						$data['MediaFiles']['updated']			=   date('Y-m-d',time());*/
							
						//$this->createMedia($data);
							
					}
	
				} else {
	
					echo 'Invalid file type.';
	
				}
					
				die;
			}
		}
	
		$this->render('uploadfile');
	}
	
	public function actionImagelistthumbsubpage($layout=null,$thumb=null,$select=null)
	{
	
		if(isset($layout)){
			$this->layout = true;
		}
	
	
		$selected = array();
	
		array_push($selected, $select);
	
		if(isset($thumb)) {
			$dataSelectedImages  = VideoFiles::model()->findAllByAttributes(array('id'=>$id));
	
			foreach ($dataSelectedImages as $image){
	
				$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
	
				//print_r($image->filemedia->attributes['id']);
			}
	
		}
	
		//die;
		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
	
	
	
		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
	
		$this->render('imagelistthumbsubpage',array(
				'dataProvider'=>$dataProvider,
				'fileUrl'=>$fileUrl,
				'selected'=>$selected,
	
		));
	
	}
	
}
