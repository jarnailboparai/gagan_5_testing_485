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
		//$this->render('index');
		
			//$this->layout = true;
			$phonegapKey = '';
		
			## SAVE NUMBER OF ARTICLES
			if (isset($num_articles) && $num_articles > 0) {
			$model = Module::model()->findByPk($module_id);
			//			$model->articles = $num_articles;
			//			$model->save();
			echo $num_articles;
			//echo $model->articles; die;
				
			}
		
			$app_id = Yii::app()->user->getState('app_id');
		if ($app_id) {
				$model = Module::model()->findByPk($module_id);
			} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
		
				$notificationModel = Notification::model()->findByAttributes(array('app_id' => $app_id));
		
						if (!isset($notificationModel))
					$notificationModel = new Notification();
		
					if (isset($_POST['Notification'])) {
			$user = Notification::model()->findByAttributes(array('app_id' => $app_id));
							$app_model = Application::model()->findByPk($app_id);
		
							$app_model->notifications = 1;
							$app_model->update();
		
							if (isset($user)) {
							$user->attributes = $_POST['Notification'];
									$certification_push_pem_path = CUploadedFile::getInstance($user, 'certification_push_pem_path');
									$apn_mobileprovision = CUploadedFile::getInstance($user, 'apn_mobileprovision');
		
									//                CVarDumper::dump( $user->attributes, 10, TRUE);die;
									$file_name = "apn_" . Yii::app()->user->id . "_" . $app_id . ".cer";
									$file_name_mobileprovision = "apn_" . Yii::app()->user->id . "_" . $app_id . ".mobileprovision";
									$ck_pem_file_name = null;
		
									if ($certification_push_pem_path) {
		
										$user->certification_push_pem_path = $file_name;
		
										$certification_push_pem_path->saveAs('tmp/' . $file_name);
										$ck_pem_file_name = $this->genratekey('tmp/' . $file_name);
									}
		
									if ($apn_mobileprovision) {
										$user->apn_mobileprovision = $file_name_mobileprovision;
		
										$apn_mobileprovision->saveAs('apple_notification_profile/' . $file_name_mobileprovision);
										$phonegapKey = $this->uploadkey('apple_notification_profile/' . $file_name_mobileprovision);
									}
		
									Notification::model()->updateAll(array(
									'name' => $_POST['Notification']['name'],
									'email' => $_POST['Notification']['email'],
									'sender_id' => $_POST['Notification']['sender_id'],
									'google_api_key' => $_POST['Notification']['google_api_key'],
									'certification_push_pem_path' => $ck_pem_file_name,
									'apn_mobileprovision' => $file_name_mobileprovision,
									'phonegap_key_id' => $phonegapKey
									), 'app_id="' . $app_id . '"');
		
									if (file_exists(Yii::app()->basePath . "/../apple_certificate_files_pem/" . $ck_pem_file_name))
										Notification::model()->updateByPk($user->id, array('certification_push_pem_path' => $ck_pem_file_name));
							} else {
		
								$notificationModel->attributes = $_POST['Notification'];
								$notificationModel->user_id = Yii::app()->user->id;
								$notificationModel->app_id = $app_id;
								$certification_push_pem_path = CUploadedFile::getInstance($notificationModel, 'certification_push_pem_path');
								$apn_mobileprovision = CUploadedFile::getInstance($notificationModel, 'apn_mobileprovision');
		
								$file_name = "apn_" . Yii::app()->user->id . "_" . $app_id . ".cer";
								$file_name_mobileprovision = "apn_" . Yii::app()->user->id . "_" . $app_id . ".mobileprovision";
								if ($certification_push_pem_path) {
		
									$notificationModel->certification_push_pem_path = $file_name;
									$certification_push_pem_path->saveAs('tmp/' . $file_name);
									$notificationModel->certification_push_pem_path = $this->genratekey('tmp/' . $file_name);
								}
		
								if ($apn_mobileprovision) {
		
									$notificationModel->apn_mobileprovision = $file_name_mobileprovision;
									$apn_mobileprovision->saveAs('apple_notification_profile/' . $file_name_mobileprovision);
									$notificationModel->phonegap_key_id = $this->uploadkey('apple_notification_profile/' . $file_name_mobileprovision);
								}
		
								$notificationModel->save();
							}
					}
		
		
					if (isset($_POST['Module'])) {
		
						//$this->pr($_POST); //die;
		
						if ($model->name != "Admob") {
							if ($_POST['Module']['tab_icon'] == '')
								unset($_POST['Module']['tab_icon']);
						}
		
						$model->attributes = $_POST['Module'];
						$model->activated = 'yes';
		
		
						/* upload-pictures-begin */
		
						/* commwnt code my SOB_A start*/
		
						$images = CUploadedFile::getInstancesByName('images');
						$app_model = Application::model()->findByPk($app_id);
		
						if(!empty($_POST['upload_url'])){
								
							$upload_path = $_POST['upload_url'];
							if ($upload_path != '') {
								$model->images = $upload_path;
								if (!empty($images)) {
									$upload_path = Yii::app()->basePath . "/../app_images/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id . "_" . "photos_files" . "_" . time();
									mkdir($upload_path, 0755);
									if ($model->images)
										$this->deleteDirectory($model->images);
									foreach ($images as $image => $pic) {
										$pic->saveAs($upload_path . '/' . $pic->name);
									}
								}
							}
								
						}
		
						//die;
		
						/* comment code my SOB_A end*/
						/* end  */
		
						if ($model->save()) {
		
							//                CVarDumper::dump($model->attributes, 10, true);die;
		
							Yii::app()->user->setFlash('success', '<strong>Success!</strong> Data has been updated Successfully.');
		
							Application::model()->updateByPk($app_id, array('build' => 'yes'));
							//$this->redirect(array('/applicationnew/listfeatures'));
							echo json_encode(array($model->tab_title,$model->name,$model->id)); die;
						} else {
							Yii::app()->user->setFlash('success', '<strong>Success!</strong> Some error.');
						}
					}
		
					if ($model->images != NULL && !$app_id ) {
		
		
						$uploadedImages = 1;
						$images = $model->images;
		
						$images_arr = $this->images_name($images);
						$imgString = '';
						$i = 1;
		
						foreach ($images_arr as $imgName) {
		
							$imgString .= '<li><a href="' . './' . $imgName . '" rel="external" ><img src="' . './' . $imgName . '" alt="Image 00' . $i . '" /></a></li>';
							$i++;
						}
		
						copy(Yii::app()->basePath . '/../www/customize_module_preview/photos_preview.html', $images . '/photos_preview.html');
		
		
						$str = implode("\n", file($images . '/photos_preview.html'));
						$fp = fopen($images . '/photos_preview.html', 'w');
						$str = str_replace('<b>Preview</b>', $imgString, $str);
						$str = str_replace('<link rel="stylesheet" href="jquery/jquery.mobile-1.1.0.min.css" />', '<link rel="stylesheet" href="../../www/customize_module_preview/jquery/jquery.mobile-1.1.0.min.css" />', $str);
						$str = str_replace('<link href="./photos_files/styles.css" type="text/css" rel="stylesheet" />', '<link href="../../www/customize_module_preview/photos_files/styles.css" type="text/css" rel="stylesheet" />', $str);
						$str = str_replace('<link href="./photos_files/photoswipe.css" type="text/css" rel="stylesheet" />', '<link href="../../www/customize_module_preview/photos_files/photoswipe.css" type="text/css" rel="stylesheet" />', $str);
						$str = str_replace('<script src="jquery-1.6.4.min.js"></script>', '<script src="../../www/customize_module_preview/jquery-1.6.4.min.js"></script>', $str);
						$str = str_replace('<script src="jquery/jquery.mobile-1.1.0.js"></script>', '<script src="../../www/customize_module_preview/jquery/jquery.mobile-1.1.0.js"></script>', $str);
		
						$str = str_replace('<script type="text/javascript" src="./photos_files/klass.min.js"></script>', '<script type="text/javascript" src="../../www/customize_module_preview/photos_files/klass.min.js"></script>', $str);
						$str = str_replace('<script type="text/javascript" src="./photos_files/code.photoswipe-3.0.5.min.js"></script>', '<script type="text/javascript" src="../../www/customize_module_preview/photos_files/code.photoswipe-3.0.5.min.js"></script>', $str);
		
						$str = str_replace('url("icons_communication_1092.png")', 'url("../../www/customize_module_preview/icons_communication_1092.png")', $str);
		
						fwrite($fp, $str, strlen($str));
					} else {
						$uploadedImages = 0;
					}
		
					$uploadedImages = 0;
		
					$style['customize_modules'] = 'class="current"';
					
					//die("controller end here");
					$this->render('addmob', array(
								'model' => $model,
								'style' => $style,
								'uploadedImages' => $uploadedImages,
								'notificationModel' => $notificationModel
						));
		
					
	}
	
	public function actionAweber()
	{
		echo json_encode(array('sdf'=>'asdf',99=>'asdf','dd'=>$_POST)); die;
		//echo json_encode(array('sdf'=>'asdf',99=>'asdf')); die;
	}
}
