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
						'actions'=>array('create','update','appkeycreate','applelist','certificatecreate','orderlist','changeappbg','videodetail','Editvideodetail','videodetailgallery','image','imagebackground','uploadbackground','image_resize','uploadimage_background','buildapp','appbg','uploadfilenew','image_resize_bg'
								,'Image_background','Image_backgroundcolor','app_bgcolor','remove_appbg','check_appbg','rss','aweber','export','subpageorderlist','admob'),
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
	{
		echo print_r($_FILES);die;
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

	public function actionImagebackground($layout=null,$type=null,$module_id=null,$app_id=null,$sub_module_id=null)
	{

		//$dataProvider=new CActiveDataProvider('MediaFiles');


		if(isset($layout)){
			$this->layout = false;
		}

		$selected = array();

		$dataSelectedImages  = ThemeSettingBackground::model()->findAllByAttributes(array('app_id'=>Yii::app()->user->getState('app_id')));

		foreach ($dataSelectedImages as $image){

			$selected[$image->attributes['id']] =  $image->attributes['media_files_id'];
			//print_r($image->filemedia->attributes['id']);
		}
			


		$dataProvider = MediaFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'flag'=>1));

		$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';

		$this->render('/mediafiles/_backgroundimagelist',array(
				'type'=>$type,
				'dataProvider'=>$dataProvider,
				'fileUrl'=>$fileUrl,
				'module_id'=>$module_id,
				'selected' =>$selected,
				'app_id'=>$app_id,
				'sub_module_id'=>$sub_module_id
		));


	}


	public function actionUploadbackground()
	{
		if(isset($_POST)){
				
			$id = $_POST['selected'][0];
			$sourse = Yii::app()->basePath. '/../mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
			$dest_path = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';

			$data = MediaFiles::model()->findByPk($id);
			$image = $dest_path.$data->filename;
			$path = $sourse.$data->filename;
			$data1 = getimagesize($path);
			$width = $data1[0];
			$height = $data1[1];
			$type = $_POST['type'];

			//	if($width>=640 && $height>=960)
			//	{
			//$app_id = Yii::app()->user->getState('app_id');
			//$modeldd = new ThemeSettingBackground();
				
			//$modeldd->deleteAllByAttributes(array('app_id'=>$app_id));
			/* if(!empty($module_id))
				{
			$model = ThemeSettingBackground::model()->findByAttributes(array('app_id'=>$app_id,'module_id'=>$module_id));
			}
			else
			{
			$model = ThemeSettingBackground::model()->findByAttributes(array('app_id'=>$app_id));
			}
			*/

			$model = Array();
			if(isset($_POST['module_id']) && $_POST['module_id']!=0)
			{
				$module_id = $_POST['module_id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>$module_id,'app_id'=>0,'sub_module_id'=>0));
					
			}elseif(isset($_POST['app_id']) && $_POST['app_id']!=0)
			{
				$app_id = $_POST['app_id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>$app_id,'sub_module_id'=>0));
					
			}elseif(isset($_POST['sub_module_id']) && $_POST['sub_module_id']!=0)
			{
				$sub_module_id = $_POST['sub_module_id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>0,'sub_module_id'=>$sub_module_id));

			}

			if(!count($model))
			{
				$model = new ThemeSettingBackground;
			}

			$mediaId = $_POST['selected'][0];

			if(isset($_POST['module_id']) && $_POST['module_id']!=0)
			{
				$model->module_id = $module_id;
			}
			elseif(isset($_POST['app_id']) && $_POST['app_id']!=0)
			{
				$model->app_id = $app_id;
			}
			elseif(isset($_POST['sub_module_id']) && $_POST['sub_module_id']!=0)
			{
				$model->sub_module_id = $sub_module_id;
			}

			if($mediaId)
			{

				if($type==1)
				{
					$model->port_media_id = $mediaId;
				}
				else if($type==2)
				{
					$model->land_media_id = $mediaId;
				}
				$model->bg_type=1;



				if($model->save())
				{
					//$imagepath = $this->actionImage_resize_bg($mediaId,$app_id);
					$response['type']=$type;
					$response['image']=$image;
					echo json_encode($response); die;
						
				}else{
					//CVarDumper::dump($model->errors,10,true);
				}
					
			}else{
				echo "stop"; die;
			}

			die;
			//	}
			//	else
			//	{
				echo "error"; die;
			//	}
		}
	}

	/*
	 * 	public function actionUploadbackground()
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
	*/

	public function actionImage_resize_bg($id=null,$appid=null)
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

		array(640,960,false,0,0,'MM');

		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);

		$layoutLayer->save($dest_path,"theme_background".".".$data->extension, true, null, 95);
		$dest_path = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/'."background/ycc_".$appid."/";
		return $dest_path."theme_background".".".$data->extension;
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




	public function actionBuildapp($id=null)
	{
		$data = Applink::model()->findByAttributes(array("application_id"=>$id));
		

		if(count($data))
		{
			$status = $data->flag;
			if($status==1)
			{
				$this->redirect(array('/applicationnew/buildAppMy','id'=>$id));
			}
			else
			{
				$data->flag =1;
				$data->update();
				$this->redirect(array('/applicationnew/buildPhoneGapAppMy','id'=>$id));
			}
		}else{
			$this->redirect(array('/applicationnew/buildPhoneGapAppMy','id'=>$id));
		}
		
		die();
	}

	// function for upload background image independetly
	public function actionAppbg()
	{
		if($_POST)
		{
			//echo "<pre>"; print_r($_FILES['MediaFiles']); die;
			/*	$tempFile = getimagesize($_FILES['MediaFiles']['tmp_name']['uploadedFile_1']);
			$width = $data1[0];
			$height = $data1[1];
			echo $width; echo "<br>";
			echo $height;
				
			$tempFile = getimagesize($_FILES['MediaFiles']['tmp_name']['uploadedFile_2']);
			$width = $data1[0];
			$height = $data1[1];
			echo $width; echo "<br>";
			echo $height;
			die;
			*/
			$appid = Yii::app()->user->getState('app_id');
			$model = ThemeSettingBackground::model()->findByAttributes(array('app_id'=>$appid));
				
			if(!count($model))
			{
				$model = new ThemeSettingBackground;
			}else{

			}
			//$data = $model->findAllByAttributes(array('app_id'=>$appid));
				
			$file = explode(".",$_FILES['MediaFiles']['name']['uploadedFile_1']);
			$file_ext = $file[1];
			$tempFile = $_FILES['MediaFiles']['tmp_name']['uploadedFile_1'];
				
			$dest_path = Yii::app()->basePath. '/../mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/'."background/ycc_".$appid."/";
				
			$imagename = $appid."_".Yii::app()->user->id."_640x960.".$file_ext;
			if (!file_exists($dest_path))
				mkdir($dest_path,0777,true);
				
			if(move_uploaded_file($tempFile, $dest_path.$imagename))
			{
				$this->actionImage_resize($dest_path,$imagename, 640, 960);
				//$model = new ThemeSettingBackground();
				$model->app_id = $appid;
				$model->image_bg1 = $imagename;

				$model->save();

				// 				if($data != NULL)
					// 				{
					// 					$model->update();
					// 				}
					// 				else
						// 				{
						// 					$model->save();
						// 				}

			}
				
				
				
			$file = explode(".",$_FILES['MediaFiles']['name']['uploadedFile_2']);
			$file_ext = $file[1];
			$tempFile = $_FILES['MediaFiles']['tmp_name']['uploadedFile_2'];
			$dest_path = Yii::app()->basePath. '/../mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/'."background/ycc_".$appid."/";

			$imagename = $appid."_".Yii::app()->user->id."_960x640.".$file_ext;
			$path =  $dest_path.$imagename;
			if (!file_exists($dest_path))
				mkdir($path,0777,true);
				
			if(move_uploaded_file($tempFile, $path))
			{
				$this->actionImage_resize($dest_path,$imagename, 960, 640);
				//$model = new ThemeSettingBackground();
				$model->app_id = $appid;
				$model->image_bg2 = $imagename;
				//$model->save();
				$model->update();
			}
				
				
		}
		$model=new MediaFiles;
		$this->render('/mediafiles/image_bg_app',array('model'=>$model));
	}


	public function actionImage_resize($path=null,$img=null,$width=null,$height=null)
	{
		$folder = $width."x".$height;
		$dest_path = $path."/".$folder ;
		if (!file_exists($dest_path))
			mkdir($dest_path,0777,true);

		Yii::import('ext.PHPImageWorkshop.*');
		$path = $path.$img;
		$layoutLayer = ImageWorkshop::initFromPath($path);

		list($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position) =

		array($width,$height,false,0,0,'MM');

		$layoutLayer->resizeInPixel($thumbWidth, $thumbHeight, $conserveProportion, $positionX, $positionY, $position);

		$layoutLayer->save($dest_path,"$img", true, null, 95);


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
						$data['MediaFiles']['flag']				=   1;
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

		$this->render('/mediafiles/uploadfile');
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

	private function createMedia($data)
	{	//echo "<pre>"; print_r($data);
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



	public function actionImage_background()
	{
		if(isset($_POST))
		{
			$url_port = "";
			$url_land = "";
			$image_port ="";
			$image_land ="";
			$module_id = null;
			$app_id= null;
			$sub_module_id = null;
			$model_data = null;
			$port_image = "";
			$land_image = "";
			$image_id = '0';

			$dest_url = Yii::app()->baseUrl. '/mediafiles/' . Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/';
			$this->layout = 1;
			$flag= $_POST['flag'];
			if(isset($_POST['id']))
			{
				$module_id = $_POST['id'];
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>$module_id,'app_id'=>0,'sub_module_id'=>0));
				$id=$module_id;
			}

			if(isset($_POST['app_id']))
			{
				$app_id = $_POST['app_id'];
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>$app_id,'sub_module_id'=>0));
				if(count($model_data)){
					$model_data->bg_type = $flag;
					$model_data->update();
				}
				$id=$app_id;
			}

			if(isset($_POST['sub_module_id']))
			{
				$sub_module_id = $_POST['sub_module_id'];
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>0,'sub_module_id'=>$sub_module_id));
				$id=$sub_module_id;
			}


			if($model_data != NULL)
			{
				$port_image = $model_data->port_media_id;
				$land_image = $model_data->land_media_id;
				$image_id = $model_data->id;

				if(!empty($port_image) || $port_image!=0)
				{
					$port_image = $model_data->port_media_id;
					$image1 = MediaFiles::model()->findByAttributes(array('id'=>$port_image));
					$image_port = $image1->filename;
					$url_port = $dest_url.$image_port;
				}

				if(!empty($land_image) || $land_image!=0)
				{
					$land_image = $model_data->land_media_id;
					$image2 = MediaFiles::model()->findByAttributes(array('id'=>$land_image));
					$image_land = $image2->filename;
					$url_land = $dest_url.$image_land;
				}
			}

			if(empty($url_port))
			{
				$app_id_image = Yii::app()->user->getState('app_id');
				$model_app = Application::model()->findByAttributes(array('id'=>$app_id_image));
				$image = $model_app->thememenu->image;
				$path = Yii::app()->baseUrl."/images/".$image;
					
				$url_port = Yii::app()->baseUrl."/images/".$image;
			}
			if(empty($url_land))
			{
				$app_id_image = Yii::app()->user->getState('app_id');
				$model_app = Application::model()->findByAttributes(array('id'=>$app_id_image));
				$image = $model_app->thememenu->image;
				$url_land = Yii::app()->baseUrl."/images/".$image;
			}

			$this->render('/mediafiles/bgimage_upload',array('image_port'=>$image_port,'image_land'=>$image_land,'module_id'=>$module_id,'url_port'=>$url_port,'url_land'=>$url_land,'app_id'=>$app_id,'sub_module_id'=>$sub_module_id,'id'=>$id,'flag'=>$flag,'image_id'=>$image_id));
		}
	}



	public function actionImage_backgroundcolor()
	{
		$port_image="";
		if(isset($_POST))
		{
			$this->layout = 1;
			$module_id = $_POST['id'];
			$flag=$_POST['flag'];
			$color_type = "";
			$color_direction ="";
			$layer="";

			if($flag==1)
			{
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>$module_id,'sub_module_id'=>0));

			}
				
			if($flag==2)
			{
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>$module_id,'app_id'=>0,'sub_module_id'=>0));
			}
				
			if($flag==3)
			{
				$model_data = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>0,'sub_module_id'=>$module_id));
			}

			if($model_data != NULL)
			{
				$port_image = $model_data->color;
				if(!empty($port_image))
				{
					$detail = $this->color_detail($port_image);
					
					if(count($detail))
					{
						$color_type = $detail['type'];
						$color_direction = $detail['direction'];
						$layer = $detail['layer'];
					}else{
						//empty($port_image);
						$port_image = null;
					}
				}	
			
					
			}
		}
		$this->render('/mediafiles/bgimage_uploadcolor',array('flag'=>$flag,'module_id'=>$module_id,'color'=>$port_image,"color_type"=>$color_type,"color_direction"=>$color_direction,"layer"=>$layer));
	}


	/*	function actionApp_bgcolor()
	 {
	if(isset($_POST)){

	$module_id = $_POST['id'];
	$color = $_POST['color'];
		
	$app_id = Yii::app()->user->getState('app_id');
		
	if(!empty($module_id))
	{
	$model = ThemeSettingBackground::model()->findByAttributes(array('app_id'=>$app_id,'module_id'=>$module_id));
	}
	else
	{
	$model = ThemeSettingBackground::model()->findByAttributes(array('app_id'=>$app_id));
	}
		
	if(isset($_POST['module_id']))
	{

	}elseif(isset($_POST['app_id'])){

	}elseif(isset($_POST['sub_module_id'])){

	}
		
		
		
		
	if(!count($model))
	{
	$model = new ThemeSettingBackground;
	}
	$model->app_id = $app_id;
	$model->color = $color;
	$model->bg_type=2;
	if($model->save())
	{
	echo $color;

	}else{
	//CVarDumper::dump($model->errors,10,true);
	}
		
	}else{
	echo "stop"; die;
	}

	die;

	echo "error"; die;
	//	}
	}
	*/

	public function actionApp_bgcolor()
	{
		if(isset($_POST)){
			$color = $_POST['color'];
			$model = Array();
			if(isset($_POST['id']))
			{
				$module_id = $_POST['id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>$module_id,'app_id'=>0,'sub_module_id'=>0));

			}elseif(isset($_POST['app_id']))
			{
				$app_id = $_POST['app_id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>$app_id,'sub_module_id'=>0));

			}elseif(isset($_POST['sub_module_id']))
			{
				$sub_module_id = $_POST['sub_module_id'];
				$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>0,'sub_module_id'=>$sub_module_id));

			}

			if(!count($model))
			{
				$model = new ThemeSettingBackground;
			}


			if(isset($_POST['id']))
			{
				$model->module_id = $module_id;
			}
			elseif(isset($_POST['app_id']))
			{
				$model->app_id = $app_id;
			}
			elseif(isset($_POST['sub_module_id']))
			{
				$model->sub_module_id = $sub_module_id;
			}

			$model->color = $color;
			$model->bg_type=2;
			if($model->save())
			{
				echo $color;
				die;
					
			}else{
				//CVarDumper::dump($model->errors,10,true);
			}
				
		}

		else{
			echo "stop"; die;
		}

		echo "error"; die;
	}
		
	public function actionRemove_appbg()
	{

		$app_id = Yii::app()->user->getState('app_id');
		$model_app = Application::model()->findByAttributes(array('id'=>$app_id));
		$image = $model_app->thememenu->image;
		$path = Yii::app()->baseUrl."/images/".$image;
		$data = Array();
		if(isset($_POST['id']))
		{
			$status = $_POST['status'];
			$id = $_POST['id'];
			$model = ThemeSettingBackground::model()->findByAttributes(array('id'=>$id));
			if($status==1)
			{
				$model->port_media_id = 0;
			}
			else if($status==2)
			{
				$model->land_media_id = 0;
			}
			$model->bg_type=1;
			if($model->update())
			{
				echo json_encode(array('status'=>$status,'image'=>$path));
				die();
			}
		}
	}
		
	public function actionCheck_appbg()
	{

		if(isset($_POST)){
			$flag = $_POST['flag'];
			$model = Array();
			if($flag==1)
			{
				if(isset($_POST['app_id']))
				{
					$app_id = $_POST['app_id'];
					$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>$app_id,'sub_module_id'=>0));

				}
			}
			else if($flag==2)
			{
				if(isset($_POST['id']))
				{
					$module_id = $_POST['id'];
					$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>$module_id,'app_id'=>0,'sub_module_id'=>0));

				}
			}
			else if($flag==3)
			{
				if(isset($_POST['sub_module_id']))
				{
					$sub_module_id = $_POST['sub_module_id'];
					$model = ThemeSettingBackground::model()->findByAttributes(array('module_id'=>0,'app_id'=>0,'sub_module_id'=>$sub_module_id));
						
				}
			}
				
			if(count($model))
			{
				echo $model->bg_type;
				die;
			}
			else
			{
				echo 3;
				die;
			}
		}
		echo error;
		die;
	}
		
	public function actionRss($module_id,$layout=null)
	{


		$app_id = Yii::app()->user->getState('app_id');
		if ($app_id) {
			$model = Module::model()->findByPk($module_id);
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}

		//

		if (isset($_POST['Module'])) {

			//$this->pr($_POST); //die;

			if ($model->name != "rss_feeds") {
				if ($_POST['Module']['tab_icon'] == '')
					$_POST['Module']['tab_icon'] == null;


			}

			$model->attributes = $_POST['Module'];
				
			if($model->update())
			{
				echo json_encode(array($model->tab_title,$model->name,$model->id)); die;
			}
		}
		//
		if($model->name == 'rss_feeds'){

			$this->render('/applicationnew/_rss_form', array(
					'model' => $model,
					//'style' => $style,
					//'uploadedImages' => $uploadedImages,
					//'notificationModel' => $notificationModel
			));

		}
	}

		
	public function actionAweber($module_id,$layout=null)
	{

		$app_id = Yii::app()->user->getState('app_id');
		if ($app_id) {
			$model = Module::model()->findByPk($module_id);
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
			
		//
			
		if (isset($_POST['Module'])) {
				
			//$this->pr($_POST); //die;
				
			if ($model->name != "aweber") {
				if ($_POST['Module']['tab_icon'] == '')
					$_POST['Module']['tab_icon'] == null;
			}
				
			$model->attributes = $_POST['Module'];
			
			$model->images = $_POST['Module']['images'];
			$model->web_page_url = $_POST['Module']['web_page_url'];
			
			if($model->update())
			{
				echo json_encode(array($model->tab_title,$model->name,$model->id)); die;
			}
		}
		//
		if($model->name == 'aweber'){
				
			$user_id =  Yii::app()->user->id;
				
			$model_weber = Aweberusers::model()->findByAttributes(array('user_id'=>$user_id));
			$aweberapplication_id = $model_weber->awerberapplication;
				
			$data = CHtml::listData(Aweberlisting::model()->findAll(array('condition'=>"aweberapplication_id=$aweberapplication_id")), 'list_id', 'name');
			$htmlOptions =     array('size' => '1', 'prompt'=>'-- select list --','class'=>'aweber_list');
				
			$this->render('/applicationnew/_aweber_form', array(
					'model' => $model,
					'data' => $data,
					'htmlOptions' => $htmlOptions,
					//'notificationModel' => $notificationModel
			));
				
		}
	}
		
		
	private function color_detail($color)
	{
		$color_detail = array();
		
		$pieces = explode(";", $color);
		if(count($pieces) > 6 ){
			$val = $pieces[0];
	
			$arr = explode("rgb", $val);
			$type = array_shift($arr);
	
			$type = explode("gradient(", $type);
			$type_c = explode(",", $type[1]);
			$c_direction = $type_c[0];
			$c_type = $type_c[1];
	
	
			$data = explode(" ", trim($c_type));
			$color_type = trim($data[0]);
			$color_detail['type']=$color_type;
			$color_direction = trim($type_c[0]);
			if ($color_direction=='center')
			{
				$color_direction =  "center center";
			}
	
			$color_detail['direction']= $color_direction ;
	
			$a =array();
			foreach ($arr as $r)
			{
				$a[]=explode(") ", $r);
	
			}
			$color = array();
			$per = array();
			foreach ($a as $a)
			{
				$color[]=$a[0];
				$per[]=$a[1];
			}
	
			foreach ($color as $c)
			{
				$color_final[] = "rgb".$c.")";
			}
	
	
			foreach ($per as $per)
			{
				$p[] = explode("%", $per);
			}
	
	
			foreach ($p as $p)
			{
				$size[] = $p[0];
			}
	
			$array_val = array();
			$i=0;
			foreach ($color_final as $color)
			{
				$array_val[$i]['color'] = $color;
				$array_val[$i]['position'] = $size[$i];
				$i++;
			}
			$layer =  json_encode ($array_val);
			$color_detail['layer']= $layer ;
	
				return $color_detail;
		
		}else{
			return $color_detail;
		}

	}
	
	public function actionExport($app_id){

		$model = Lead::model()->with('listdata')->findAllByAttributes(array('app_id'=>$app_id));
		$appname = Application::model()->findByAttributes(array('id'=>$app_id));
		$name =  $appname->title;
		$this->csvexport($model,$name);

	}
	
	private function csvexport($model,$name)
	{
		$file = $name."_".date('Y-m-d')."_".date('H:i:s').".xls";
		require_once(__DIR__.'/../extensions/csv/PHPExcel.php');
		
		$objPHPExcel = new PHPExcel();
		
		if(count($model))
			{
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'NAME')
		->setCellValue('B1', 'EMAIL')
		->setCellValue('C1', 'MODULE NAME')
		->setCellValue('D1', 'LIST NAME');
		
		$a=2;
		
		foreach ($model as $m)
		{
			$list_name = "";
			if(count($m->listdata))
			{
				$list_name = $m->listdata->name;
			}
			else 
			{
				$list_name = " ";
			}
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A$a", "$m->name")
			->setCellValue("B$a", "$m->email")
			->setCellValue("C$a", "$m->module_name")
			->setCellValue("D$a", "$list_name");
			$a++;
		}
		
		}
		else
		{
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No Record found');
		}
		
		
		$objPHPExcel->getActiveSheet()->setTitle('leads');
		
		
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=$file");
		header('Cache-Control: max-age=0');
		
		header('Cache-Control: max-age=1');
		
		
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	
	
	public function actionSubpageorderlist()
	{
		//echo "<pre>"; print_r($_POST); die;
	
		if(isset($_POST['submodule']))
		{
			$temp = 1;
			foreach($_POST['submodule'] as $data)
			{
				$model =  SubModules::model()->findByPk($data);
	
				//print_r($model->attributes);
				$model->module_order = $temp;
	
				$temp++;
	
				$model->update();
			}
	
		}else{
	
		}
	}
	

	
	public function actionAdmob($module_id,$layout=null)
	{
	
	
		$app_id = Yii::app()->user->getState('app_id');
		if ($app_id) {
			$model = Module::model()->findByPk($module_id);
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
	
		//
	
		if (isset($_POST['Module'])) {
	
			//$this->pr($_POST); //die;
	
			if ($model->name != "admob") {
				if ($_POST['Module']['tab_icon'] == '')
					$_POST['Module']['tab_icon'] == null;
	
	
			}
	
			$model->attributes = $_POST['Module'];
	
			if($model->update())
			{
				echo json_encode(array($model->tab_title,$model->name,$model->id)); die;
			}
		}
		//
		if($model->name == 'admob'){
	
			$this->render('/applicationnew/_admob_form', array(
					'model' => $model,
					//'style' => $style,
					//'uploadedImages' => $uploadedImages,
					//'notificationModel' => $notificationModel
			));
	
		}
	}
		
}