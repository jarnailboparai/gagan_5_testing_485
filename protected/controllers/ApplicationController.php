<?php

set_time_limit(0);

Yii::setPathOfAlias('Buzz', Yii::getPathOfAlias('application.vendors.Buzz'));

Yii::setPathOfAlias('Github', Yii::getPathOfAlias('application.vendors.Github'));

Yii::import('application.vendors.*');
require_once 'phonagap.php';

class ApplicationController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	//    var $file_to_copy = array(
	//        'icons/dark/64Px_-_250.png', 'jquery/jfeed.js', 'jquery/jquery.mobile.structure-1.1.0.css', 'jquery/jquery.mobile.structure-1.1.0.min.css',
	//        'jquery/jquery.mobile.theme-1.1.0.css', 'jquery/jquery.mobile.theme-1.1.0.min.css', 'jquery/jquery.mobile-1.1.0.css',
	//        'jquery/jquery.mobile-1.1.0.js', 'jquery/jquery.mobile-1.1.0.min.css', 'jquery/jquery.mobile-1.1.0.min.js',
	//        'jquery/images/ajax-loader.gif', 'jquery/images/ajax-loader.png', 'jquery/images/icons-18-black.png', 'jquery/images/icons-18-white.png',
	//        'jquery/images/icons-36-black.png', 'jquery/images/icons-36-white.png', '64Px_-_504-11.png', '64Px_-_504-210.png', '64Px_-_504-249.png',
	//        '64Px_-_504-249.png', 'dark-64Px-249.png', 'icons_communication_1092.png', 'icons_tech_1579.png', 'loading.gif', 'more.png',
	//        'more_64Px_-_504-2.png', 'more_64Px_-_504-21.png', 'more_64Px_-_504-86.png', 'more_64Px_-_504-103.png', 'more_64Px_-_504-165.png',
	//        'more_64Px_-_504-183.png', 'more_64Px_-_504-220.png', 'more_64Px_-_504-272.png', 'more_64Px_-_504-358.png', 'more_64Px_-_504-366.png',
	//        'more_64Px_-_504-367.png', 'more_64Px_-_504-372.png', 'more_64Px_-_504-395.png', 'more_64Px_-_504-456.png', 'more_icons_shop_1002.png',
	//        'more_icons_shop_1032.png', 'more_icons_social_1244.png', 'jquery-1.6.4.min.js', 'jquery.youtube.channel2.js',
	//        'jquery.youtube.channel.js', 'cordova-2.0.0.js', 'barcodescanner.js', 'theme.css', 'config.xml', 'home.png'
	//    );
	//



	var $file_to_copy = array(
	'icons/dark/64Px_-_250.png', 'jquery/jfeed.js', 'jquery/jquery.mobile.structure-1.1.0.css', 'jquery/jquery.mobile.structure-1.1.0.min.css',
	'jquery/jquery.mobile.theme-1.1.0.css', 'jquery/jquery.mobile.theme-1.1.0.min.css', 'jquery/jquery.mobile-1.1.0.css',
	'jquery/jquery.mobile-1.1.0.js', 'jquery/jquery.mobile-1.1.0.min.css', 'jquery/jquery.mobile-1.1.0.min.js',
	'jquery/images/ajax-loader.gif', 'jquery/images/ajax-loader.png', 'jquery/images/icons-18-black.png', 'jquery/images/icons-18-white.png',
	'jquery/images/icons-36-black.png', 'jquery/images/icons-36-white.png', '64Px_-_504-11.png', '64Px_-_504-210.png', '64Px_-_504-249.png',
	'64Px_-_504-249.png', 'dark-64Px-249.png', 'icons_communication_1092.png', 'icons_tech_1579.png', 'loading.gif', 'more.png',
	'more_64Px_-_504-2.png', 'more_64Px_-_504-21.png', 'more_64Px_-_504-86.png', 'more_64Px_-_504-103.png', 'more_64Px_-_504-165.png',
	'more_64Px_-_504-183.png', 'more_64Px_-_504-220.png', 'more_64Px_-_504-272.png', 'more_64Px_-_504-358.png', 'more_64Px_-_504-366.png',
	'more_64Px_-_504-367.png', 'more_64Px_-_504-372.png', 'more_64Px_-_504-395.png', 'more_64Px_-_504-456.png', 'more_icons_shop_1002.png',
	'more_icons_shop_1032.png', 'more_icons_social_1244.png', 'jquery-1.6.4.min.js', 'jquery.youtube.channel2.js',
	'jquery.youtube.channel.js', 'cordova-2.0.0.js', 'theme.css', 'config.xml', 'home.png'
	);

	private $git_tree = array();

	private $base_tree = '';

	private $git_client;

	private $reposit;

	private $gitBlobCnt = 0;

	private $destination;


	public function beforeAction($action)
	{
		$this->layout = '//layouts/column2';
		return parent::beforeAction($action);
	}

	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array(
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array(
						'class' => 'CViewAction',
				),
		);
	}

	public function actionDelete($app_id)
	{
		$this->removeFromPhoneGapBuild($app_id);

			$app_model = Application::model()->findByPk($app_id);

			$myFile = Yii::getPathOfAlias('webroot') . '/applications/' . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;

			$this->deleteDirectory($myFile);

			/* * *****delete launch and icon images on app_images folder ****** */

			$iconImage = Yii::getPathOfAlias('webroot') . '/app_images/' . $app_model->icon;

			$launchImage = Yii::getPathOfAlias('webroot') . '/app_images/' . $app_model->launch_image;

			if (is_file($iconImage))
				unlink($iconImage);

			if (is_file($launchImage))
				unlink($launchImage);

			/*         * ***--------------------------------------------------------**** */

			$contentModule = Module::model()->findByAttributes(array('application_id' => $app_id, 'name' => 'photos'));

			if (isset($contentModule) && is_dir($contentModule->images))
				$this->deleteDirectory($contentModule->images);

			Module::model()->deleteAllByAttributes(array('application_id' => $app_id));

			Build::model()->deleteAllByAttributes(array('application_id' => $app_id));

			Gcm::model()->deleteAllByAttributes(array('app_id' => $app_id));

			Application::model()->deleteByPk($app_id);

			$this->redirect(array('/application/dashboard'));
	}

	public function removeFromPhoneGapBuild($app_id)
	{

		$app_model = Application::model()->findByPk($app_id);

		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);

		$app_info = $phone->getApp($app_model->pg_appid);

		if (property_exists($app_info, 'repo')) {

			$this->removeFromRepo($app_info->repo);

			$phone->deleteApp($app_model->pg_appid);
		}
	}

	public function removeFromRepo($repo)
	{

		$repo = preg_replace("/https?(:\/\/github.com\/cgfmedia\/)(.*)\.git/", "$2", $repo);

		$this->git_client = new Github\Client();

		$this->git_client->authenticate(Yii::app()->params->gitUsername, Yii::app()->params->gitPassword, Github\Client::AUTH_HTTP_PASSWORD);

		try {

			$this->git_client->api('repo')->remove(Yii::app()->params->gitUsername, $repo);

		} catch (Exception $exc) {

		}
	}

	public function deleteDirectory($dir)
	{

		if (!file_exists($dir))
			return true;

		if (!is_dir($dir) || is_link($dir))
			return unlink($dir);


		foreach (scandir($dir) as $item) {

			if ($item == '.' || $item == '..')
				continue;

			if (!$this->deleteDirectory($dir . "/" . $item)) {


				chmod($dir . "/" . $item, 0777);

				if (!$this->deleteDirectory($dir . "/" . $item))
					return false;
			};
		}







		return rmdir($dir);
	}

	/**
	  * This is the default 'index' action that is invoked
	  * when an action is not explicitly requested by users.
	  */
	
	public function actionHome()
	{
		$this->render('home');
	}

	public function actionDashboard()
	{
		$user_id = Yii::app()->user->id;

		$model = Application::model()->findAllByAttributes(array('user_id' => $user_id));
		//print_r($model); die;
		// echo '<pre>'; print_r($_SESSION); print_r(Yii::app()->user); die;

		$this->render('dashboard', array(
				'model' => $model,
		));
			
	}

	public function actionDetails()
	{
		$app_id = (isset($_GET['app_id'])) ? $_GET['app_id'] : 0;

		if ($app_id > 0) {

			Yii::app()->user->setState('app_id', $app_id);
			$model = Application::model()->findByPk($app_id);
		} else {

			$app_id = Yii::app()->user->getState('app_id');
			$type = (isset($_GET['type'])) ? $_GET['type'] : '';
			if ($type == 'new')
				$model = new Application('details');
			elseif ($type == '' && $app_id == 0)
				$model = new Application('details');
			else
				$model = Application::model()->findByPk($app_id);
		}

		if (isset($_POST['Application'])) {
			
			//$this->pr($_POST['Application']);
			
			if (!$_POST['Application']['icon'])
				unset($_POST['Application']['icon']);

			/*             * ******Change App title-begin******* */

			if (is_dir(Yii::app()->basePath . "/../applications/" . Yii::app()->user->getState('username') . "_" . $model->title . "_" . $model->id))
				$this->deleteDirectory(Yii::app()->basePath . "/../applications/" . Yii::app()->user->getState('username') . "_" . $model->title . "_" . $model->id);

			/*             * ********end***** */

			//$_POST['Application']['title'] = str_replace(' ', '-', $_POST['Application']['title']);

			$model->attributes = $_POST['Application'];
			$model->new_icon = CUploadedFile::getInstance($model, 'icon');

			if ($model->new_icon) {

				if ($model->icon != NULL && is_file(Yii::getPathOfAlias('webroot') . "/app_images/" . $model->icon)) {

					unlink(Yii::getPathOfAlias('webroot') . "/app_images/" . $model->icon);
				}

				$model->icon = time() . '_' . $model->new_icon;
			}

			$model->user_id = Yii::app()->user->id;
			$model->build = 'yes';

			if ($model->save()) {

				if ($model->new_icon)
					$model->new_icon->saveAs(Yii::getPathOfAlias('webroot') . '/app_images/' . $model->icon);

				if (isset($_GET['type']) && $_GET['type'] == 'new')
					Yii::app()->user->setState('app_id', $model->primaryKey);

				$this->redirect(array('application/modules'));
			}
			else {
				//CVarDumper::dump($model->errors,10,true);
			}
		}

		$style['details'] = 'class="current"';

		if (isset($type) && $type == 'new')
			$this->render('details', array(
					'model' => $model,
					'disabled' => 'onclick="return false;" style="opacity: 0.5;" ',
					'style' => $style
			));
		else
			$this->render('details', array(
					'model' => $model,
					'disable_app' => 'disabled',
					'style' => $style
			));
	}

	public function actionModules() 
	{
		$app_id = Yii::app()->user->getState('app_id');
		//$this->pr($_SESSION);

		if ($app_id) {
			$model = new Module;
			$app_model = Application::model()->findByPk($app_id);
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}

		if (isset($_POST['Module'])) {
			$model->attributes = $_POST['Module'];
			$module_files = ModuleFile::model()->findAll();

			$content_flag = true;
			foreach ($module_files as $obj) {
				$mod = $obj['attributes'];
				$mod_name = $mod['name'];

				$new_model = Module::model()->findByAttributes(array('application_id' => $app_id, 'name' => $mod_name));

				if ($new_model != NULL && $mod_name == 'content') {
					if ($new_model->content_count != '' && $new_model->content_count > 0 && $new_model->content_count != $_POST['content_count']) {

						for ($j = 1; $j <= $new_model->content_count; $j++) {

							if ($j == 1)
								$m_name = 'content';
							else
								$m_name = 'content' . $j;

							$n_model = Module::model()->findByAttributes(array('application_id' => $app_id, 'name' => $m_name));

							if ($n_model != NULL) {
								//echo $n_model->name."<br>";
								$n_model->delete();
								$n_model = NULL;
								//echo "$m_name Del new_model not null <br>";
							}
						}
						$new_model = NULL;
					}
				}

				if ($model->name == NULL)
					$model->name = array();

				if (in_array($mod_name, $model->name)) {
					if ($new_model == NULL) {
						//echo "<br>$mod_name if <br>";
						$insert = new Module;
						$insert->application_id = $app_id;
						$insert->name = $mod_name;
						$insert->activated = 'no';
						if ($content_flag && $mod_name == 'content') {
							// echo " Content Flag <br>";
							$no_of_contents = $_POST['content_count'];
							if ($no_of_contents != '' && $no_of_contents > 0) {
								//  echo " NOC: $no_of_contents <br>";
								for ($i = 1; $i <= $no_of_contents; $i++) {

									$insert = new Module;
									$insert->application_id = $app_id;
									$insert->name = $mod_name;
									$insert->activated = 'no';
									if ($i == 1)
										$insert->name = 'content';
									else
										$insert->name = 'content' . $i;
									$insert->content_count = $no_of_contents;
									$insert->save();
									//echo "Save ".$insert->name."<br>";
								}
							}else {
								$insert->save();
								//echo "Save ".$insert->name."<br>";
							}
							$content_flag = false;
						}

						if ($mod_name != 'content') {
							$insert->save();
							//echo "Save ".$insert->name."<br>";
						}
					}
				} else {
					if ($new_model != NULL) {
						$new_model->delete();
						//echo "[+]$mod_name Del new_model not null <br>";
					}
				}
			}

			$this->redirect(array('/application/customizeModules'));
		}


		$modules = Module::model()->findAllByAttributes(array('application_id' => $app_id));
		$modules_arr = array();
		$content_count = 0;
		foreach ($modules as $obj) {
			$m = $obj['attributes'];
			$name = $m['name'];
			$modules_arr[] = $name;
			if (substr($m['name'], 0, 7) == 'content') {
				$content_count = $m['content_count'];
			}
		}

		$style['modules'] = 'class="current"';
		$this->render('modules', array(
				'model' => $model,
				'app_model' => $app_model,
				'modules' => $modules_arr,
				'content_count' => $content_count,
				'style' => $style,
		));
	}

	public function actionCustomizeModules()
	{
		$app_id = Yii::app()->user->getState('app_id');

		if ($app_id) {

			$model = Module::model()->findAllByAttributes(array('application_id' => $app_id));

			$application_model = Application::model()->findByPk($app_id);
			
		} else {

			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');

			$this->redirect(array('details'));
		}

		if (isset($_POST['Application'])) {
			
			//$this->pr($_POST['Application']);

			$application_model->attributes = $_POST['Application'];

			if ($application_model->save()) {

				Application::model()->updateByPk($app_id, array('build' => 'yes'));

				$this->redirect(array('/application/moduleOrder'));
			}
		}

		$style['customize_modules'] = 'class="current"';

		$this->render('customize_modules', array(
				'model' => $model,
				'application_model' => $application_model,
				'style' => $style
		));
	}

	public function genratekey($apn_devalopment) 
	{
		//   CVarDumper::dump(shell_exec("dir"), 10, true);die;

		$app_id = Yii::app()->user->getState('app_id');

		$profile = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

		$p12key = Yii::getPathOfAlias("webroot") . "/apple_certificate_files/" . $profile->p12_file;

		$key = $profile->apple_p12_password;

		$ck_file = "ck_" . Yii::app()->user->id . "_" . $app_id . ".pem";

		$base_path = Yii::getPathOfAlias("webroot") . "/tmp";

		$apn_devalopment = Yii::getPathOfAlias("webroot") . "/" . $apn_devalopment;

		shell_exec("openssl x509 -in $apn_devalopment -inform der -out $base_path/PushChatCert.pem");

		shell_exec("openssl pkcs12 -nocerts -out $base_path/PushChatKey.pem -in $p12key -password pass:$key -passout pass:$key");

		shell_exec("cat $base_path/PushChatCert.pem $base_path/PushChatKey.pem > " . Yii::getPathOfAlias("webroot") . "/apple_certificate_files_pem/" . "$ck_file");

		return $ck_file;
	}

	public function actionCustomizeModuleDetails($module_id, $num_articles = 0) 
	{
		$phonegapKey = '';

		## SAVE NUMBER OF ARTICLES
		if (isset($num_articles) && $num_articles > 0) {
			$model = Module::model()->findByPk($module_id);
			$model->articles = $num_articles;
			$model->save();
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
			
// 			$this->pr($_POST);

			if ($model->name != "Admob") {
				if ($_POST['Module']['tab_icon'] == '')
					unset($_POST['Module']['tab_icon']);
			}

			$model->attributes = $_POST['Module'];
			$model->activated = 'yes';


			/* upload-pictures-begin */

			/* commwnt code my SOB_A start*/
			/*
			$images = CUploadedFile::getInstancesByName('images');
			$app_model = Application::model()->findByPk($app_id);
			
			$upload_path = $_POST['upload_url'];
			if ($upload_path != '') {
				$model->images = $upload_path;
				if (!empty($images)) {
//                  $upload_path = Yii::app()->basePath . "/../app_images/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id . "_" . "photos_files" . "_" . time();
					mkdir($upload_path, 0755);
//                  if ($model->images)
//                     $this->deleteDirectory($model->images);
					foreach ($images as $image => $pic) {
						$pic->saveAs($upload_path . '/' . $pic->name);
					}
				}
			}
			*/
			/* comment code my SOB_A end*/
			/* end  */

			if ($model->save()) {

				//                CVarDumper::dump($model->attributes, 10, true);die;

				Yii::app()->user->setFlash('success', '<strong>Success!</strong> Data has been updated Successfully.');

				Application::model()->updateByPk($app_id, array('build' => 'yes'));
				$this->redirect(array('/application/customizemodules'));
			} else {
				Yii::app()->user->setFlash('success', '<strong>Success!</strong> Some error.');
			}
		}

		//        if ($model->images != NULL) {
		//
		//
		//            $uploadedImages = 1;
		//            $images = $model->images;
		//
		//            $images_arr = $this->images_name($images);
		//            $imgString = '';
		//            $i = 1;
		//
		//            foreach ($images_arr as $imgName) {
		//
		//                $imgString .= '<li><a href="' . './' . $imgName . '" rel="external" ><img src="' . './' . $imgName . '" alt="Image 00' . $i . '" /></a></li>';
		//                $i++;
		//            }
		//
		//            copy(Yii::app()->basePath . '/../www/customize_module_preview/photos_preview.html', $images . '/photos_preview.html');
		//
		//
		//            $str = implode("\n", file($images . '/photos_preview.html'));
		//            $fp = fopen($images . '/photos_preview.html', 'w');
		//            $str = str_replace('<b>Preview</b>', $imgString, $str);
		//            $str = str_replace('<link rel="stylesheet" href="jquery/jquery.mobile-1.1.0.min.css" />', '<link rel="stylesheet" href="../../www/customize_module_preview/jquery/jquery.mobile-1.1.0.min.css" />', $str);
		//            $str = str_replace('<link href="./photos_files/styles.css" type="text/css" rel="stylesheet" />', '<link href="../../www/customize_module_preview/photos_files/styles.css" type="text/css" rel="stylesheet" />', $str);
		//            $str = str_replace('<link href="./photos_files/photoswipe.css" type="text/css" rel="stylesheet" />', '<link href="../../www/customize_module_preview/photos_files/photoswipe.css" type="text/css" rel="stylesheet" />', $str);
		//            $str = str_replace('<script src="jquery-1.6.4.min.js"></script>', '<script src="../../www/customize_module_preview/jquery-1.6.4.min.js"></script>', $str);
		//            $str = str_replace('<script src="jquery/jquery.mobile-1.1.0.js"></script>', '<script src="../../www/customize_module_preview/jquery/jquery.mobile-1.1.0.js"></script>', $str);
		//
		//            $str = str_replace('<script type="text/javascript" src="./photos_files/klass.min.js"></script>', '<script type="text/javascript" src="../../www/customize_module_preview/photos_files/klass.min.js"></script>', $str);
		//            $str = str_replace('<script type="text/javascript" src="./photos_files/code.photoswipe-3.0.5.min.js"></script>', '<script type="text/javascript" src="../../www/customize_module_preview/photos_files/code.photoswipe-3.0.5.min.js"></script>', $str);
		//
		//            $str = str_replace('url("icons_communication_1092.png")', 'url("../../www/customize_module_preview/icons_communication_1092.png")', $str);
		//
		//            fwrite($fp, $str, strlen($str));
		//        } else {
		//            $uploadedImages = 0;
		//        }

		$uploadedImages = 0;
		
		$style['customize_modules'] = 'class="current"';

		$this->render('customize_module_details', array(
				'model' => $model,
				'style' => $style,
				'uploadedImages' => $uploadedImages,
				'notificationModel' => $notificationModel
		));
	}

	public function uploadkey($mobilepro) 
	{
		$model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
		$res = $phone->setKeysIOS(Yii::app()->user->username . "_notification_" . $model->id, $model->apple_p12_password, "./apple_certificate_files/" . $model->p12_file, "./" . $mobilepro);
		if ($res) {
			return $res->id;
		}
	}

	public function actionModuleOrder() 
	{
		$app_id = Yii::app()->user->getState('app_id');
		if ($app_id) {
			$model = Module::model()->findAllByAttributes(array('application_id' => $app_id), array('order' => 'module_order'));
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
		if (!empty($_POST)) {
			foreach ($model as $obj) {
				$module = $obj['attributes'];
				if (isset($_POST[$module['name']])) {
					$order = $_POST[$module['name']];
					Module::model()->updateByPk($module['id'], array('module_order' => $order));
				}
			}
			Application::model()->updateByPk($app_id, array('build' => 'yes'));
			$this->redirect(array('/application/splash'));
		}
		$style['module_order'] = 'class="current"';
		$this->render('module_order', array(
				'model' => $model,
				'style' => $style
		));
	}

	public function actionSplash() 
	{
		if (Yii::app()->user->hasState('app_id'))
			$app_id = Yii::app()->user->getState('app_id');
		//echo $app_id; exit;
		if ($app_id) {
			$model = Application::model()->findByPk($app_id);
			$model->scenario = 'splash';
			//CVarDumper::dump($model->attributes,10,true);die;
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
		if (isset($_POST['Application'])) {
			if (!$_POST['Application']['launch_image'])
				unset($_POST['Application']['launch_image']);
			$model->attributes = $_POST['Application'];
			$model->new_launch_image = CUploadedFile::getInstance($model, 'launch_image');
			if ($model->new_launch_image) {
				if ($model->launch_image != NULL && is_file(Yii::getPathOfAlias('webroot') . "/app_images/" . $model->launch_image))
					unlink(Yii::getPathOfAlias('webroot') . "/app_images/" . $model->launch_image);
				$model->launch_image = time() . '_' . $model->new_launch_image;
			}
			if ($model->save()) {
				if ($model->new_launch_image)
					$model->new_launch_image->saveAs(Yii::getPathOfAlias('webroot') . '/app_images/' . $model->launch_image);
				$this->redirect(array('application/finalpreview'));
			}
			else {
				//CVarDumper::dump($model->errors,10,true);
			}
		}
		$style['splash'] = 'class="current"';
		$this->render('splash', array('model' => $model, 'style' => $style));
	}

	public function actionFinalPreview($app_id = 0) 
	{

		if ($app_id > 0) {
			$preview = true;
			Yii::app()->user->setState('app_id', $app_id);
		} else {
			$preview = false;
			$app_id = Yii::app()->user->getState('app_id');
		}
		if ($app_id) {
			$model = Application::model()->findByPk($app_id);
		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}
		$module_model = Module::model()->findAllByAttributes(array('application_id' => $app_id));
		$app_model = Application::model()->findByPk($app_id);
		$android_location = '';

		$folder = Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
		//$folder = 'demo' . "_" . $app_model->title . "_" . $app_model->id;
		if (!$preview)
			$this->buildApplication($app_id);
		Application::model()->updateByPk($app_id, array('build' => 'yes'));
		$style['final_preview'] = 'class="current"';

		$this->render('final_preview', array(
				'folder' => $folder,
				'style' => $style
		));
	}

	private function get_blob($param) 
	{

		try {
			$newBlob = $this->git_client->api('git')->blobs()->create(Yii::app()->params->gitUsername, $this->reposit, array('content' => base64_encode(file_get_contents($param)), 'encoding' => 'base64'));
		} catch (Exception $exc) {
			echo $param . '<br>';
			echo $exc . '<br>';
			//die;
		}

		//$this->pr($newBlob); 
		// die;
		
		return $newBlob['sha'];
	}

	private function make_tree($param) 
	{
		//$this->prd($param);
		
		if ($handle = opendir($param)) {

			while (false !== ($entry = readdir($handle))) {

				if ($entry != "." && $entry != "..") {


					if (is_dir("$param/$entry")) {

						$this->make_tree("$param/$entry");
					} else {

						$path = "$param/$entry";
						$refine_path = str_replace("$this->destination/", '', $path);
						$sha = $this->get_blob("$param/$entry");
						if ($sha != null) {
							array_push($this->git_tree, array('path' => $refine_path
							, 'mode' => '100644'
									, 'type' => 'blob'
											, 'sha' => $sha
							));
						}
					}
				}
			}
			closedir($handle);
		}
	}

	private function git_up($file_name) 
	{
		//echo "<pre>";
		//$this->pr($file_name);
		
		$this->git_client->api('git')->blobs()->configure('raw');

		try {
			$new_repo = $this->git_client->api('repo')->create($this->reposit);
		} catch (Exception $exc) {
			//echo $exc->getMessage(); die;
			$new_repo = $this->git_client->api('repo')->show(Yii::app()->params->gitUsername, $this->reposit);
			//$this->prd($new_repo);
		}

		$comit = $this->git_client->api('git')->commits()->show(Yii::app()->params->gitUsername, $this->reposit, 'master');
		$this->base_tree = $comit['commit']['tree']['sha'];

		$this->make_tree($file_name);

		$treeData = array('tree' => $this->git_tree);

		$newTree = $this->git_client->api('git')->trees()->create(Yii::app()->params->gitUsername, $this->reposit, $treeData);

		$comitParam = array('message' => 'This is some new one.', 'tree' => $newTree['sha'], 'parents' => $comit['sha']);

		$comitObj = $this->git_client->api('git')->commits()->create(Yii::app()->params->gitUsername, $this->reposit, $comitParam);

		$this->git_client->api('git')->references()->update(Yii::app()->params->gitUsername, $this->reposit, 'heads/master', array('force' => false, 'sha' => $comitObj['sha']));

		$app_id = Yii::app()->user->getState('app_id');
		$app_model = Application::model()->findByPk($app_id);
		$app_model->git_repo_url = $new_repo['clone_url'];
		$app_model->update();
		
		$this->buildPhoneGapApp($app_model);
	}

	public function buildPhoneGapApp($param) 
	{

		//        CVarDumper::dump($param, 10,true);

		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);

		//        $app_id = Yii::app()->user->getState('app_id');
		//        $app_model = Application::model()->findByPk($app_id);

		$a_profile_model = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

		$ios_profile_model = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		$key = array();
		if ($param->notifications == 1) {
			$app_id = Yii::app()->user->getState('app_id');
			$notificationModel = Notification::model()->findByAttributes(array('app_id' => $app_id));
			if ($notificationModel->phonegap_key_id != 0) {
				$ios_profile_model->phonegap_id = $notificationModel->phonegap_key_id;
			}
		}
		if (isset($a_profile_model) && $a_profile_model->phonegap_id != 0) {
			$key = array("android" => array('id' => (int) $a_profile_model->phonegap_id, 'key_pw' => $a_profile_model->android_keystore_password, 'keystore_pw' => $a_profile_model->android_keystore_password));
		}
		if (isset($ios_profile_model) && $ios_profile_model->phonegap_id != 0) {
			$key = array("ios" => array('id' => (int) $ios_profile_model->phonegap_id, 'password' => $ios_profile_model->apple_p12_password));
		}
		if ((isset($ios_profile_model) && $ios_profile_model->phonegap_id != 0) && (isset($a_profile_model) && $a_profile_model->phonegap_id != 0)) {
			$key = array(
					"android" => array('id' => (int) $a_profile_model->phonegap_id, 'key_pw' => $a_profile_model->android_keystore_password, 'keystore_pw' => $a_profile_model->android_keystore_password),
					"ios" => array('id' => (int) $ios_profile_model->phonegap_id, 'password' => $ios_profile_model->apple_p12_password)
			);
		}
		//        $key = array("android" => array('id' => (int) $a_profile_model->phonegap_id, 'key_pw' => $a_profile_model->android_keystore_password,'keystore_pw' => $a_profile_model->android_keystore_password)
		//                     ,"ios" => array('id' => (int) $ios_profile_model->phonegap_id, 'password' => $ios_profile_model->apple_p12_password));


		$app_info = $phone->uploadApp($param->git_repo_url, $param->title, 'remote_repo', $key);
		if ($app_info) {
			$param->pg_appid = $app_info;

			$param->update();
		} else {

			Yii::app()->user->setFlash('create_app_error', 'Some Error in Phone gap build');

			$this->redirect(array('details'));
		}
	}

	public function actionBuildAppSelections() 
	{
		$app_id = Yii::app()->user->getState('app_id');
			
		if ($app_id) {
			$model = Application::model()->findByPk($app_id);

		} else {
			Yii::app()->user->setFlash('create_app_error', 'Please Create Application by Filling these Details');
			$this->redirect(array('details'));
		}

		$style['build_app_selections'] = 'class="current"';

		//        if (isset($_POST['Application'])) {
		//        $model->attributes = $_POST['Application'];
		//            CVarDumper::dump($_POST['Application'], 10, TRUE);DIE;
		//        if ($model->save()) {

		$this->git_client = new Github\Client();

		$app_folder = Yii::app()->user->getState('username') . "_" . $model->title . "_" . $model->id;
		//$app_folder = Yii::app()->user->getState('username') . "_" . $model->id;

			
		$this->reposit = $app_folder;
		$this->git_client->authenticate(Yii::app()->params->gitUsername, Yii::app()->params->gitPassword, Github\Client::AUTH_HTTP_PASSWORD);
		$this->destination = Yii::app()->basePath . "/../applications/" . $app_folder;
		// echo "<pre>"; die(print_r($this->destination,true));
		$this->git_up($this->destination);
			
		$this->redirect(array('buildapp'));
		//        }
		//        } else {
		//
		//            $this->render('build_app_selections', array('model' => $model, 'style' => $style));
		//
		//        }
	}

	public function actionBuildApp() 
	{
		$app_id = Yii::app()->user->getState('app_id');

		$app_model = Application::model()->findByPk($app_id);

		$plateform = (isset($_GET['plateform'])) ? $_GET['plateform'] : 'android';

		$apps = array();

		$phonegap = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);

		$getApp_status = $phonegap->getApp($app_model->pg_appid);

		//        echo $getApp_status->status->android; exit;

		if ($getApp_status) {

			$apps[0]['android_link'] = $phonegap->getDownloadLink($app_model->pg_appid, 'android');

			$apps[0]['android_status'] = $getApp_status->status->android;

			$apps[0]['ios_link'] = $phonegap->getDownloadLink($app_model->pg_appid, 'ios');

			$apps[0]['ios_status'] = $getApp_status->status->ios;

			$apps[0]['time'] = '';
		}

		$style['build_app'] = 'class="current"';

		$this->render('build_app', array(
				'apps' => $apps,
				'style' => $style
		));
	}

	/**
	  * This is the action to handle external exceptions.
      */
	public function actionError() 
	{

		if ($error = Yii::app()->errorHandler->error) {

			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	private function generateMenu($str, $app_model, $content_File = '') 
	{

		$menu = '<div data-role="footer" data-position="fixed" class="nav-glyphish-example" data-id="myfooter" data-theme="a" data-tap-toggle="false">';
	
		$menu.='<div data-role="navbar" class="nav-glyphish-example">';
	
		$menu.='<ul>';
	
		//foreach loop will come here
	
		$module = Module::model()->findAllByAttributes(array('application_id' => $app_model->id), array('order' => 'module_order'));
	
	
		$count = 0;
	
		foreach ($module as $obj) {
	
			if ($obj->attributes['name'] == 'Admob')
				continue;
	
	
			if (isset($obj->attributes['tab_icon'])) {
	
				switch ($obj->attributes['name']) {
	
					case 'news(keyword)': {
						$html = 'news.html';
					}
					break;
					case 'events(keyword)': {
						$html = 'events.html';
					}
					break;
					case 'youtube(keyword)': {
						$html = 'youtubeKeywords.html';
					}
					break;
					case 'photoGallery(keyword)': {
						$html = 'photoGalleryKeywords.html';
					}
					break;
					case 'local_news': {
						$html = 'localNews.html';
					}
					break;
					case 'local_events': {
						$html = 'localEvents.html';
					}
					break;
					case 'deals': {
						$html = 'deals.html';
					}
					break;
					case 'photo_gallery': {
						$html = 'photoGallery.html';
					}
					break;
					case 'about_us': {
						$html = 'aboutUs.html';
					}
					break;
					case 'location': {
						$html = 'location.html';
					}
					break;
					case 'opening_hours': {
						$html = 'openingHours.html';
					}
	
					break;
					case 'testimonials': {
						$html = 'testimonials.html';
					}
					break;
					case 'contact_form': {
						$html = 'contactForm.html';
					}
					break;
					case 'barcode_scanner': {
						$html = 'barcodescanner.html';
					}
					break;
					case 'twitter': {
						if (isset($obj->attributes['username']))
							$html = 'https://mobile.twitter.com/' . $obj->attributes['username'];
						else
							$html = 'https://mobile.twitter.com/';
					}
					break;
					case 'facebook': {
						if (isset($obj->attributes['username']))
							$html = 'http://m.facebook.com/' . $obj->attributes['username'] . '?v=feed';
						else
							$html = 'http://m.facebook.com/?v=feed';
					}
					break;
					case 'youtube': {
						$html = 'youtube.html';
					}
					break;
					case 'twitter(keyword)': {
						if (isset($obj->attributes['keyword']))
							$html = 'https://mobile.twitter.com/search?q=' . $obj->attributes['keyword'];
						else
							$html = 'https://mobile.twitter.com/search?q=';
					}
					break;
					case 'rss_feeds': {
						$html = 'rss.html';
					}
					break;
					case 'web_page': {
						$html = $obj->attributes['web_page_url'];
					}
					break;
					case 'contact_us': {
						$html = 'contactUs.html';
					}
					break;
					case 'content': {
						$html = 'content.html';
					}
					break;
					case 'photos': {
						$html = 'photos.html';
					}
					break;
					case 'notification': {
						$html = 'notification.html';
					}
					break;
					case 'optin_form': {
						$html = 'optin_form.html';
					}
					break;
				}
	
				if (strpos($obj->attributes['name'], 'content') !== false) {
					if ($html == 'content.html') {
						$html = ($content_File != '') ? $content_File : 'content1.html';
					} else {
						$html = $obj->attributes['name'] . '.html';
					}
				}
				$tab_img = explode('/', $obj->attributes['tab_icon']);
				$index = count($tab_img) - 1;
	
	
	
				$str = str_replace('#tab2 .ui-icon { background:  url("icons_communication_1092.png") 50% 50% no-repeat; background-size: 50px 50px; }', '#tab2 .ui-icon { background:  url("icons_communication_1092.png") 50% 50% no-repeat; background-size: 50px 50px; }  a[href="' . $html . '"] .ui-icon { background:  url("' . $tab_img[$index] . '") 50% 50% no-repeat !important;background-size: 30px 30px !important; } ', $str);
	
	
	
				$dest_path = Yii::app()->basePath . "/../applications/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
	
				copy($obj->attributes['tab_icon'], $dest_path . '/' . $tab_img[$index]);
			}
	
	
			$count++;
	
			if ($count == 5)
				break;
	
	
			$m = $obj->attributes;
			
			//$this->pr($m);
			
			$file = ModuleFile::model()->findByAttributes(array('name' => $m['name']));
	
			
			
			if ($m['name'] == 'facebook' || $m['name'] == 'twitter') {
				$username = $m['username'];
				$link = str_replace("%username%", $username, $file->file);
			} else if ($m['name'] == 'twitter(keyword)') {
				$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;
				$link = str_replace("%keyword%", $keyword, $file->file);
			} else if ($m['name'] == 'web_page') {
				$link = $obj->attributes['web_page_url'];
			} else {
				/* if(!isset($file->file)){
					echo "<pre>sd"; print_r($file); die; } */
				$link = $file->file;
			}
	
			
	
			if (strpos($obj->attributes['name'], 'content') !== false) {
	
				if ($link == 'content.html') {
					$link = ($content_File != '') ? $content_File : 'content1.html';
				} else {
					$link = $obj->attributes['name'] . '.html';
				}
			}
	
	
			if ($m['tab_title'] == NULL)
				$title = $file->title;
			else
				$title = $m['tab_title'];
	
			$onclick = "window.open('" . $link . "','_self', 'location=yes')";
	
			$menu.='<li><a href="' . $link . '" id="tab2" data-icon="custom" rel="external"  data-gourl="' . $link . '" class="" onclick="' . $onclick . '">' . $title . '</a></li>';
		}
	
	
		$menu.='<li><a href="more.html" id="tab5" data-icon="custom" rel="external">More</a></li>';
	
		$menu.='</ul></div></div>';
	
		$str = str_replace('<div data-role="footer" data-position="fixed" class="nav-glyphish-example" data-id="myfooter" data-theme="a" data-tap-toggle="false"><div data-role="navbar" class="nav-glyphish-example"><ul></ul></div></div>', $menu, $str);
	
		return $str;
	}

	private function Zip($source, $destination) 
	{

		if (!extension_loaded('zip') || !file_exists($source)) {
			echo "ss";
			return false;
		}

		
		$zip = new ZipArchive();

		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			
			return false;
		}

		$source = str_replace('\\', '/', realpath($source));

		if (is_dir($source) === true) {

			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

			foreach ($files as $file) {

				$file = str_replace('\\', '/', realpath($file));

				if (is_dir($file) === true) {

					$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
				} else if (is_file($file) === true) {


					if (strpos($file, 'www.zip')) {

						continue;
					}

					$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		} else if (is_file($source) === true) {

			$zip->addFromString(basename($source), file_get_contents($source));
		}

		
		return $zip->close();
	}

	private function buildApplication($app_id)
	{
		$module_model = Module::model()->findAllByAttributes(array('application_id' => $app_id), array('order' => 'module_order'));

		$app_model = Application::model()->findByPk($app_id);

		$build_model = Build::model()->findByAttributes(array('application_id' => $app_id));

		if ($app_model->build == 'yes') {

			$src_path = Yii::app()->basePath . "/../www/";

			$dest_path = Yii::app()->basePath . "/../applications/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;


			//Creates Necessary User Directories


			if (!file_exists($dest_path))
				mkdir($dest_path);

			if (!file_exists($dest_path . '/icons'))
				mkdir($dest_path . '/icons');

			if (!file_exists($dest_path . '/icons/dark'))
				mkdir($dest_path . '/icons/dark');

			if (!file_exists($dest_path . '/jquery'))
				mkdir($dest_path . '/jquery');

			if (!file_exists($dest_path . '/jquery/images'))
				mkdir($dest_path . '/jquery/images');


			//Copies Necessary Files into Created Directory


			foreach ($this->file_to_copy as $file) {
				copy($src_path . '/' . $file, $dest_path . '/' . $file);
			}
			//Copy Application Icon


			if ($app_model->launch_image)
				//copy(Yii::getPathOfAlias('webroot') . '/app_images/' . $app_model->launch_image, $dest_path . '/' . $app_model->launch_image);


			if ($app_model->icon)
				//copy(Yii::getPathOfAlias('webroot') . '/app_images/' . $app_model->icon, $dest_path . '/' . $app_model->icon);

			//Change Config.xml

			$strConfig = implode("\n", file($dest_path . '/config.xml'));

			$fp = fopen($dest_path . '/config.xml', 'w');

			$strConfig = str_replace('<name>Hello World</name>', '<name>' . $app_model->title . '</name>', $strConfig);

			$strConfig = str_replace('com.phonegap.hello-world', $app_model->id_app, $strConfig);

			$strConfig = str_replace('<description>Hello World sample application that responds to the deviceready event.</description>', '<description>' . $app_model->description . '</description>', $strConfig);


			$strConfig = str_replace('<icon src="icon.png" />', '<icon src="' . $app_model->icon . '" />', $strConfig);

			fwrite($fp, $strConfig, strlen($strConfig));


			//Change Content of Index File

			$str = implode("\n", file($src_path . '/index.html'));

			$fp = fopen($dest_path . '/index.html', 'w');


			if ($app_model->launch_image == NULL)
				$launchImage = "";
			else
				$launchImage = "background-image: url('$app_model->launch_image');";


			$str = str_replace("background-image: url(\"Default.png\");", $launchImage, $str);


			if ($app_model->launch_tab_title == NULL)
				$launchTabTitle = "Title";
			else
				$launchTabTitle = $app_model->launch_tab_title;

			$str = str_replace("<center><h1>Title</h1></center>", "<center><h1>$launchTabTitle</h1></center>", $str);


			if ($app_model->phone) {
				$str = str_replace('<div class="ui-block-a" style="visibility: hidden"><a href="tel:phone" data-role="button" rel="external">Call Us</a></div>', "<div class='ui-block-a'><a href='tel:$app_model->phone' data-role='button' rel='external'>$app_model->phone_title</a></div>", $str);
			}

			if ($app_model->email) {

				$str = str_replace('<div class="ui-block-b" style="visibility: hidden"><a href="mailto:email" data-role="button" rel="external">Email Us</a></div>', "<div class='ui-block-b'><a href='mailto:$app_model->email' data-role='button' rel='external'>$app_model->email_title</a></div>", $str);
			}

			$str = $this->generateMenu($str, $app_model);

			fwrite($fp, $str, strlen($str));
			$notValue = false;

			$count = 0;
			$more_menu = '<ul data-role="listview" data-inset="true" data-theme="a" id="mainUl">';

			$more_menu .= '<li class="odd"><a href="index.html" rel="external" class="more-link"><img src="64Px_-_504-249.png" class="ui-li-icon" width="20px" height="20px"><span class="more-link">Home</span></a></li>';

			foreach ($module_model as $obj) {

				$count++;
				//CVarDumper::dump($obj->attributes['name'],10,true);

				$module = $obj->attributes['name'];

				if ($module == 'news(keyword)') {

					$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/news.html'));

					$fp = fopen($dest_path . '/news.html', 'w');

					$str = str_replace('var RSS = "http://news.google.com/news?q=keyword&output=rss&num=100";', "var RSS = 'http://news.google.com/news?q=$keyword&output=rss&num=100';", $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>News</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'events(keyword)') {
					$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/events.html'));

					$fp = fopen($dest_path . '/events.html', 'w');

					$str = str_replace('var RSS = "var RSS="http://www.eventbrite.com/directoryxml/?q=keyword";', "var RSS='http://www.eventbrite.com/directoryxml/?q=$keyword';", $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Events</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'rss_feeds') {

					$url = $obj->attributes['rss_feed_url'];

					$str = implode("\n", file($src_path . '/rss.html'));

					$fp = fopen($dest_path . '/rss.html', 'w');

					$str = str_replace('http://news.google.com/news?q=keyword&output=rss&num=100', $url, $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Rss feed</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'youtube(keyword)') {

					$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/youtubeKeywords.html'));
					$fp = fopen($dest_path . '/youtubeKeywords.html', 'w');

					$str = str_replace("userName: 'Cars',", "userName: '$keyword',", $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Youtube</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'photoGallery(keyword)') {

					$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/photoGalleryKeywords.html'));

					$fp = fopen($dest_path . '/photoGalleryKeywords.html', 'w');

					$str = str_replace("http://api.flickr.com/services/feeds/photos_public.gne?tags=Cars&format=rss2", "http://api.flickr.com/services/feeds/photos_public.gne?tags=$keyword&format=rss2", $str);

					$str = str_replace("<p>This is the description</p>", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Photos</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'local_news') {

					$str = implode("\n", file($src_path . '/localNews.html'));

					$fp = fopen($dest_path . '/localNews.html', 'w');


					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Local News</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'local_events') {

					$str = implode("\n", file($src_path . '/localEvents.html'));

					$fp = fopen($dest_path . '/localEvents.html', 'w');

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Local Events</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'deals') {

					$str = implode("\n", file($src_path . '/deals.html'));

					$fp = fopen($dest_path . '/deals.html', 'w');
					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Deals</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);
					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'photo_gallery') {
					$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;
					$str = implode("\n", file($src_path . '/photoGallery.html'));
					$fp = fopen($dest_path . '/photoGallery.html', 'w');
					$str = str_replace("%id%", $obj->attributes['username'], $str);
					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Photos</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);
					$str = $this->generateMenu($str, $app_model);
					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'about_us') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/aboutUs.html'));

					$fp = fopen($dest_path . '/aboutUs.html', 'w');

					$str = str_replace("<p>This is all about us.</p>", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>About Us</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'location') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/location.html'));

					$fp = fopen($dest_path . '/location.html', 'w');

					$str = str_replace("%location%", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Location</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'opening_hours') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/openingHours.html'));

					$fp = fopen($dest_path . '/openingHours.html', 'w');

					$str = str_replace("<p>Opening Hours body</p>", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Hours</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'testimonials') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/testimonials.html'));

					$fp = fopen($dest_path . '/testimonials.html', 'w');

					$str = str_replace("<p>This is testimonials body</p>", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Reviews</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'contact_us') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/contactUs.html'));

					$fp = fopen($dest_path . '/contactUs.html', 'w');

					$str = str_replace("%contact_us%", $obj->attributes['description'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Contact Us</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'youtube') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/youtube.html'));

					$fp = fopen($dest_path . '/youtube.html', 'w');

					$str = str_replace("%username%", $obj->attributes['username'], $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Youtube</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'barcode_scanner') {

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/barcodescanner.html'));

					$fp = fopen($dest_path . '/barcodescanner.html', 'w');

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Barcode Scanner</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'photos') {

					//                    require_once 'SimpleImage.php';
					//
					//                    $keyword = $app_model->master_keyword;
					//
					//                    $str = implode("\n", file($src_path . '/photos.html'));
					//
					//                    $fp = fopen($dest_path . '/photos.html', 'w');
					//
					//                    $this->recurse_copy($src_path . '/photos_files', $dest_path . '/photos_files');
					//
					//                    if ($obj->attributes['images'] != NULL) {
					//
					//                        $this->deleteDirectory($dest_path . '/photos_files/images/full');
					//
					//                        $this->deleteDirectory($dest_path . '/photos_files/images/thumb');
					//
					//                        $this->recurse_copy($obj->attributes['images'], $dest_path . '/photos_files/images/full');
					//
					//                        $this->recurse_copy($obj->attributes['images'], $dest_path . '/photos_files/images/thumb');
					//
					//                        $path = $obj->attributes['images'];
					//
					//                        $dir_handle = @opendir($path) or die("ERROR: Cannot open  <b>$path</b>");
					//
					//                        $image = new SimpleImage();
					//
					//                        while ($file = readdir($dir_handle)) {
					//
					//                            if ($file != "." && $file != ".." && $file != 'photos_preview.html') {
					//
					//                                $image->load($path . '/' . $file);
					//
					//                                $image->resize(150, 150);
					//
					//                                $image->save($dest_path . '/photos_files/images/thumb/' . $file);
					//                            }
					//
					//                        }
					//
					//                        closedir($dir_handle);
					//
					//                        $full_images_names_arr = $this->images_name($dest_path . '/photos_files/images/full');
					//
					//                        $images_string = '';
					//
					//                        foreach ($full_images_names_arr as $image_name) {
					//
					//                            $images_string .= '<li><a href="photos_files/images/full/' . $image_name . '" rel="external" ><img src="photos_files/images/thumb/' . $image_name . '"  /></a></li>';
					//                        }
					//                        echo $images_string;
					//                        die;
					//
					//                        $str = str_replace("<b>No uploaded images</b>", $images_string, $str);
					//                    }
					//
					//                    if ($obj->attributes['tab_title'] != NULL)
					//                        $str = str_replace("<h1>Photos</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);
					//
					//                    $str = $this->generateMenu($str, $app_model);
					//
					//                    fwrite($fp, $str, strlen($str));
					//
					require_once 'SimpleImage.php';

					$keyword = $app_model->master_keyword;

					$str = implode("\n", file($src_path . '/photos.html'));

					$fp = fopen($dest_path . '/photos.html', 'w');

					$this->recurse_copy($src_path . '/photos_files', $dest_path . '/photos_files');

					if ($obj->attributes['images'] != NULL) {
						$path = $obj->attributes['images'];
						//                        $this->deleteDirectory($dest_path . '/photos_files/images/full');
						//
						//                        $this->deleteDirectory($dest_path . '/photos_files/images/thumb');
						if (!file_exists($obj->attributes['images'])) {
							$path = $dest_path . '/photos_files/images/full';
						}
						$this->recurse_copy($path, $dest_path . '/photos_files/images/full');

						//                        $this->recurse_copy($obj->attributes['images'], $dest_path . '/photos_files/images/thumb');



						$dir_handle = @opendir($path) or die("ERROR: Cannot open  <b>$path</b>");

						$image = new SimpleImage();

						while ($file = readdir($dir_handle)) {

							if ($file != "." && $file != ".." && $file != 'photos_preview.html') {

								$image->load($path . '/' . $file);

								$image->resize(150, 150);

								$image->save($dest_path . '/photos_files/images/thumb/' . $file);
							}
						}

						closedir($dir_handle);

						$full_images_names_arr = $this->images_name($dest_path . '/photos_files/images/full');

						$images_string = '';

						foreach ($full_images_names_arr as $image_name) {

							$images_string .= '<li><a href="photos_files/images/full/' . $image_name . '" rel="external" ><img src="photos_files/images/thumb/' . $image_name . '"  /></a></li>';
						}

						$mystr = str_replace(Yii::app()->getBaseUrl(true) . "/www/customize_module_preview/photos_files/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id, Yii::app()->getBaseUrl(true) . "/applications/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id . "/photos_files/images/full", $obj->attributes['description']);

						if ($images_string!='')
							$str = str_replace("<b>No uploaded images</b>", $images_string, $str);


						Module::model()->updateAll(array(
						'description' => $mystr), 'id="' . $obj->attributes['id'] . '"');
						$this->deleteDirectory($path);
					}

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Photos</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}
				else if ($module == 'optin_form') {

					$str = implode("\n", file($src_path . '/content.html'));

					$fp = fopen($dest_path . '/optin_form.html', 'w');

					$description = trim($obj->attributes['description']);
					if ($description == '')
						$description = '<p><b>optin is empty!</b></p>';
					else
						$description = $obj->attributes['description'];

					$str = str_replace("<p>This is all about us.</p>", $description, $str);

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Content</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);
					else
						$str = str_replace("<h1>Content</h1>", "<h1>" . "Opt Form" . "</h1>", $str);
					copy(Yii::getPathOfAlias('webroot') . '/www/customize_module_preview/backMenu.png', $dest_path . '/backMenu.png');

					$str = $this->generateMenu($str, $app_model);

					fwrite($fp, $str, strlen($str));
				}

				else if ($module == 'content') {

					$keyword = $app_model->master_keyword;
					$result = Module::model()->getContents($obj->attributes['application_id']);
					$contentFiles = array();
					if ($result) {

						foreach ($result as $rs) {

							if (substr($rs['name'], 0, 7) == 'content') {

								if ($rs['name'] == 'content')
									$file = 'content1.html';
								else
									$file = $rs['name'] . '.html';


								$str = implode("\n", file($src_path . '/content.html'));
								$fp = fopen($dest_path . '/' . $file, 'w');
								$description = trim($rs['description']);
								if ($description == '')
									$description = '<p><b>Content is empty!</b></p>';
								else
									$description = $rs['description'];

								//                                $description = str_replace('data-role="listview"', "", $description);
								$str = str_replace("<p>This is all about us.</p>", $description, $str);

								if ($rs['tab_title'] != NULL)
									$str = str_replace("<h1>Content</h1>", "<h1>" . $rs['tab_title'] . "</h1>", $str);

								copy(Yii::getPathOfAlias('webroot') . '/www/customize_module_preview/backMenu.png', $dest_path . '/backMenu.png');

								$str = $this->generateMenu($str, $app_model, $file);

								fwrite($fp, $str, strlen($str));
								$tabTitle = ($rs['tab_title'] != NULL ) ? $rs['tab_title'] : 'Content';
								$contentFiles[] = array('title' => $tabTitle, 'link' => $file);
							}
						}
					}
				}
				else if ($module == 'notification') {


					$notValue = true;
					$keyword = $app_model->master_keyword;
					$str = implode("\n", file($src_path . '/notification.html'));
					$fp = fopen($dest_path . '/notification.html', 'w');

					if ($obj->attributes['tab_title'] != NULL)
						$str = str_replace("<h1>Notification</h1>", "<h1>" . $obj->attributes['tab_title'] . "</h1>", $str);

					$str = str_replace("%app_id%", (string) $app_id, $str);
					$notResult = Notification::model()->findByAttributes(array('app_id' => $app_id));

					if (isset($notResult) && !empty($notResult->sender_id)) {

						$str = str_replace("%sender_id%", (string) $notResult->sender_id, $str);

						$baseUrl = explode('?', Yii::app()->createAbsoluteUrl('user/activateEmail', array('emailActivationKey' => "")));

						$str = str_replace("%url_base%", $baseUrl[0] . "?r=notification/registered", $str);

						$str = str_replace("<li><b>Please insert data in customize notification.</b></li>", "", $str);
					}

					$str = $this->generateMenu($str, $app_model);
					fwrite($fp, $str, strlen($str));

					foreach ($module_model as $obj) {


						if ($obj->attributes['name'] == 'Admob' || $obj->attributes['name'] == 'twitter' || $obj->attributes['name'] == 'facebook' || $obj->attributes['name'] == 'twitter(keyword)' || $obj->attributes['name'] == 'notification' || $obj->attributes['name'] == 'photos' || substr($obj->attributes['name'], 0, 7) == 'content')
							continue;

						//if (substr($obj->attributes['name'], 0, 7) != 'content')

						$fileName = "/" . $obj->attributes['name'] . ".html";

						if ($fileName == '/youtube(keyword).html')
							$fileName = '/youtubeKeywords.html';

						switch ($fileName) {

							case '/news(keyword).html':
								$fileName = '/news.html';
								break;
							case '/events(keyword).html':
								$fileName = '/events.html';
								break;
							case '/rss_feeds.html':
								$fileName = '/rss.html';
								break;
							case '/youtube(keyword).html':
								$fileName = '/youtubeKeywords.html';
								break;
							case '/photoGallery(keyword).html':
								$fileName = '/photoGalleryKeywords.html';
								break;
							case '/local_news.html':
								$fileName = '/localNews.html';
								break;
							case '/local_events.html':
								$fileName = '/localEvents.html';
								break;
							case '/photo_gallery.html':
								$fileName = '/photoGallery.html';
								break;
							case '/about_us.html':
								$fileName = '/aboutUs.html';
								break;
							case '/opening_hours.html':
								$fileName = '/openingHours.html';
								break;
							case '/contact_us.html':
								$fileName = '/contactUs.html';
								break;
							case '/barcode_scanner.html':
								$fileName = '/barcodescanner.html';
								break;
							case '/contact_us.html':
								$fileName = '/contactUs.html';
								break;
							case '/contact_us.html':
								$fileName = '/contactUs.html';
								break;
						}

						//$this->pr(file($dest_path . $fileName)); die;
						//echo $dest_path.$fileName;die;
						$str1 = implode("\n", file($dest_path . $fileName));
						$fp = fopen($dest_path . $fileName, 'w');


						$notScriptStr = implode("\n", file($src_path . "/notification_script.php"));
						$str1 = str_replace("<!--Turn off notification-->", $notScriptStr, $str1);

						$str1 = str_replace("%app_id%", (string) $app_id, $str1);

						if (isset($notResult) && !empty($notResult->sender_id)) {

							$str1 = str_replace("%sender_id%", (string) $notResult->sender_id, $str1);

							$baseUrl = explode('?', Yii::app()->createAbsoluteUrl('user/activateEmail', array('emailActivationKey' => "")));

							$str = str_replace("%url_base%", $baseUrl[0] . "?r=notification/registered", $str);
						}

						fwrite($fp, $str1, strlen($str1));
					}

					//                    copy($src_path . '/PushNotification.js', $dest_path . '/PushNotification.js');
				} else if ($module == 'Admob') {
					//                    $module_file_admob = ModuleFile::model()->findByAttributes(array('title' => 'Admob'));

					$admobContent = explode('<!--admob-->', $obj['description']);
					$strIndex = implode("\n", file($dest_path . '/index.html'));
					$fp = fopen($dest_path . '/index.html', 'w');

					$strIndex = str_replace("<!--Admob Script-->", $admobContent[0], $strIndex);

					$strIndex = str_replace("<!--Admob Content Script-->", $admobContent[1], $strIndex);
					fwrite($fp, $strIndex, strlen($strIndex));
				}


				$file_model = File::model()->findByAttributes(array('name' => $obj->attributes['name']));


				if ($obj->attributes['name'] == 'rss_feeds') {


					//echo "<pre>"; print_r($file_model->file); echo "</pre>"; exit;
				}

				if ($file_model != null) {

					if ($file_model->name == 'facebook' || $file_model->name == 'twitter') {
						$username = $obj->attributes['username'];
						$link = str_replace("%username%", $username, $file_model->file);
					} else if ($file_model->name == 'twitter(keyword)') {

						$keyword = ($obj->attributes['keyword'] != '') ? $obj->attributes['keyword'] : $app_model->master_keyword;
						$link = str_replace("%keyword%", $keyword, $file_model->file);
					} else if ($file_model->name == 'web_page') {
						$link = $obj->attributes['web_page_url'];
					} else {
						$link = $file_model->file;
					}

					if ($link == 'content.html') {
						if (!empty($contentFiles)) {
							foreach ($contentFiles as $cFile) {
								$onclick = "window.open('" . $cFile['link'] . "','_self', 'location=yes')";
								$more_menu .= '<li id="' . $count . '" class="">
										<a href="' . $cFile['link'] . '" data-gourl="' . $cFile['link'] . '" rel="external" class="" onclick="' . $onclick . '"><img src="' . $file_model->icon . '" class="ui-li-icon" width="20px" height="20px"><span class="more-link">' . $cFile['title'] . '</span></a></li>';
							}
						}
					} elseif ($file_model->name == 'Admob') {
						$more_menu .= '';
					} else {

						if ($file_model->name == 'facebook' || $file_model->name == 'twitter' || $file_model->name == 'twitter(keyword)')
							$onclick = "window.open('" . $link . "','_blank')";
						else
							$onclick = "window.open('" . $link . "','_self', 'location=yes')";

						if ($obj->attributes['tab_title'] == NULL)
							$moreTitle = $file_model->title;
						else
							$moreTitle = $obj->attributes['tab_title'];

						if ($moreTitle == 'Admob')
							continue;

						$more_menu .= '<li id="' . $count . '" class="">

								<a href="' . $link . '" data-gourl="' . $link . '" rel="external" class="" onclick="' . $onclick . '">

										<img src="' . $file_model->icon . '" class="ui-li-icon" width="20px" height="20px"><span class="more-link">' . $moreTitle . '</span>
												</a>

												</li>';
					}
				}
			} //end of foreach

			$more_menu .= '</ul>';

			//Create more Page

			$str = implode("\n", file($src_path . '/more.html'));
			$fp = fopen($dest_path . '/more.html', 'w');
			$find = '<ul data-role="listview" data-inset="true" data-theme="a" id="mainUl"></ul>';
			$str = str_replace($find, $more_menu, $str);
			$str = $this->generateMenu($str, $app_model);
			fwrite($fp, $str, strlen($str));

			/*             * *************For notification - Begin**************** */
			if ($notValue) {

				$arrIndexMore = array('/index.html', '/more.html');

				foreach ($arrIndexMore as $nameHtml) {

					$str1 = implode("\n", file($dest_path . $nameHtml));
					$fp = fopen($dest_path . $nameHtml, 'w');

					$notScriptStr = implode("\n", file($src_path . "/notification_script.php"));

					$str1 = str_replace("<!--Turn off notification-->", $notScriptStr, $str1);
					$str1 = str_replace("%app_id%", (string) $app_id, $str1);

					if (isset($notResult) && !empty($notResult->sender_id)) {

						$str1 = str_replace("%sender_id%", (string) $notResult->sender_id, $str1);

						$baseUrl = explode('?', Yii::app()->createAbsoluteUrl('user/activateEmail', array('emailActivationKey' => "")));

						$str = str_replace("%url_base%", $baseUrl[0] . "?r=notification/registered", $str);
					}

					fwrite($fp, $str1, strlen($str1));
				}
			}
			/*             * *************For notification - End**************** */
		}
	}

	public function recurse_copy($src, $dst) 
	{
		$dir = opendir($src);

		@mkdir($dst);

		while (false !== ( $file = readdir($dir))) {

			if (( $file != '.' ) && ( $file != '..' )) {

				if (is_dir($src . '/' . $file)) {

					$this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
				} else {


					copy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		}

		closedir($dir);
	}

	public function images_name($src) 
	{
		$img_arr = array();
		$dir = opendir($src);

		while (false !== ( $file = readdir($dir))) {

			if (( $file != '.' ) && ( $file != '..' ) && !preg_match("/.html/i", $file)) {

				$img_arr[] = $file;
			}
		}

		closedir($dir);
		return $img_arr;
	}

	private function AddIosKey($phonegap_app_id) 
	{

		$ios = AppleProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

		$phonegap_id = $ios->phonegap_id;

		if ($phonegap_id > 0) {

			$cmd = "$ curl -u tayyabshabab@yahoo.com:tayyab -X PUT -d 'data={\"keys\":{\"ios\":$phonegap_id}}' https://build.phonegap.com/api/v1/apps/$phonegap_app_id";

			$out = shell_exec($cmd);
		}
	}

	public function allowedActions() 
	{
		return 'changeAppColor,mytestzip,mytestzipapp';
	}

	public function actionChangeAppColor() 
	{

		require_once 'simple_html_dom.php';
		$app_id = Yii::app()->user->getState('app_id');

		$app_model = Application::model()->findByPk($app_id);

		$myFile = Yii::getPathOfAlias('webroot') . '/applications/' . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id . '/' . $_POST['page'];

		$html = file_get_html($myFile);

		if (!isset($_POST['link'])) {

			$_POST['inputArr'] = array_filter($_POST['inputArr']);


			foreach ($_POST['inputArr'] as $key => $value) {
				switch ($key) {
					case 1: {
						if ($_POST['page'] == 'index.html') {
							foreach ($html->find('div[data-role="page"]') as $element) {
								$element->setAttribute('style', 'background-color: #' . $value . ';');
							}
						} else {
							foreach ($html->find('div[data-role="page"]') as $element) {
								$element->setAttribute('style', 'background: #' . $value . ';');
							}
						}
					}
					break;
					case 2: {
						foreach ($html->find('div[data-role="content"]') as $element) {
							$element->setAttribute('style', 'color: #' . $value . ';');
						}
					}
					break;
					case 3: {
						foreach ($html->find('div[class="ui-bar"]') as $element) {
							$element->setAttribute('style', 'background: #' . $value . ';');
						}
					}
					break;
					case 4: {
						foreach ($html->find('div[class="ui-bar"]') as $element) {

							$element->setAttribute('style', 'background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#' . $_POST['inputArr'][3] . '), color-stop(100%,#' . $value . ')); background: -webkit-linear-gradient(top, #' . $_POST['inputArr'][3] . ' 0%,#' . $value . ' 100%); background: linear-gradient(to bottom, #' . $_POST['inputArr'][3] . ' 0%,#' . $value . ' 100%);');
						}
					}
					break;
					case 5: {
						foreach ($html->find('.ui-bar center') as $element) {
							$element->setAttribute('style', 'color: #' . $value . ';');
						}
					}
					break;
					case 6: {
						foreach ($html->find('h1') as $element) {
							$element->setAttribute('style', 'text-shadow:2px 2px 2px #' . $value . ';');
						}
					}
					break;
					case 7: {
						foreach ($html->find('div[data-role="header"]') as $element) {
							$element->setAttribute('style', 'border:1px solid #' . $value . ';');
						}
					}
					break;
					case 8: {
						foreach ($html->find('a[data-icon="custom"]') as $element) {
							$element->setAttribute('style', 'background: #' . $value . ';');
						}
					}
					break;
					case 9: {

						foreach ($html->find('a[data-icon="custom"]') as $element) {

							$element->setAttribute('style', 'background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#' . $_POST['inputArr'][8] . '), color-stop(100%,#' . $value . ')); background: -webkit-linear-gradient(top, #' . $_POST['inputArr'][8] . ' 0%,#' . $value . ' 100%); background: linear-gradient(to bottom, #' . $_POST['inputArr'][8] . ' 0%,#' . $value . ' 100%);');
						}

						$styleCSS = $html->find('style', -1)->innertext;
						$html->find('style', -1)->innertext = $styleCSS . 'a.ui-btn-down-a{ background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#' . $value . '), color-stop(100%,#' . $_POST['inputArr'][8] . ')) !important; background: -webkit-linear-gradient(top, #' . $value . ' 0%,#' . $_POST['inputArr'][8] . ' 100%) !important;  background: linear-gradient(to bottom, #' . $value . ' 0%,#' . $_POST['inputArr'][8] . ' 100%) !important;}';
					}
					break;
					case 10: {
						foreach ($html->find('a[data-icon="custom"]') as $element) {
							$styleFooter = $element->getAttribute('style');
							$styleFooter .= 'color: #' . $value . ';';
							$element->setAttribute('style', $styleFooter);
						}
					}
					break;
					case 11: {
						foreach ($html->find('a[data-icon="custom"]') as $element) {
							$styleFooter = $element->getAttribute('style');
							$styleFooter .= 'text-shadow: 2px 2px 2px #' . $value . ';';
							$element->setAttribute('style', $styleFooter);
						}
					}
					break;
					case 12: {
						foreach ($html->find('a[data-role="button"]') as $element) {
							$styleButton = 'border: 1px solid #' . $value . ';';
							$element->setAttribute('style', $styleButton);
						}
					}
					break;

					case 13: {
						foreach ($html->find('a[data-role="button"]') as $element) {
							$styleButton = $element->getAttribute('style');
							$styleButton .= 'color: #' . $value . ';';
							$element->setAttribute('style', $styleButton);
						}
					}

					break;

					case 14: {
						foreach ($html->find('a[data-role="button"]') as $element) {
							$styleButton = $element->getAttribute('style');
							$styleButton .= 'background: #' . $value . ';';
							$element->setAttribute('style', $styleButton);
						}
					}
					break;
					case 15: {
						foreach ($html->find('a[data-role="button"]') as $element) {
							$styleButton = $element->getAttribute('style');
							$styleButton .= 'background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#' . $_POST['inputArr'][14] . '), color-stop(100%,#' . $value . ')); background: -webkit-linear-gradient(top, #' . $_POST['inputArr'][14] . ' 0%,#' . $value . ' 100%); background: linear-gradient(to bottom, #' . $_POST['inputArr'][14] . ' 0%,#' . $value . ' 100%);';

							$element->setAttribute('style', $styleButton);
						}
						$styleCSS = $html->find('style', -1)->innertext;
						$html->find('style', -1)->innertext = $styleCSS . 'a.ui-btn-down-c{background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#' . $value . '), color-stop(100%,#' . $_POST['inputArr'][14] . ')) !important;
								background: -webkit-linear-gradient(top, #' . $value . ' 0%,#' . $_POST['inputArr'][14] . ' 100%) !important; background: linear-gradient(to bottom, #' . $value . ' 0%,#' . $_POST['inputArr'][14] . ' 100%) !important;}';
					}

					break;
					case 16: {
						foreach ($html->find('a[data-role="button"]') as $element) {
							$styleButton = $element->getAttribute('style');
							$styleButton .= 'text-shadow: 0 1px 0 #' . $value . ';';
							$element->setAttribute('style', $styleButton);
						}
					}
					break;
					case 17: {
						$i = 1;
						foreach ($html->find('ul[data-role="listview"] li') as $element) {

							if ($i % 2 != 0) {
								$styleList = 'background: #' . $value . ';';
								$element->setAttribute('style', $styleList);
							}

							$i++;
						}

						$styleCSS = $html->find('style', -1)->innertext;
						$html->find('style', -1)->innertext = $styleCSS . 'li.ui-btn-down-a{ opacity: 0.6; }';
					}
					break;
					case 18: {
						$i = 1;
						foreach ($html->find('ul[data-role="listview"] li') as $element) {
							if ($i % 2 == 0) {
								$styleList = 'background: #' . $value . ';';
								$element->setAttribute('style', $styleList);
							}
							$i++;
						}
						$styleCSS = $html->find('style', -1)->innertext;
						$html->find('style', -1)->innertext = $styleCSS . 'li.ui-btn-down-a{ opacity: 0.6; }';
					}
					break;
					case 19: {
						foreach ($html->find('.more-link') as $element) {
							$styleListLink = 'color: #' . $value . ';';
							$element->setAttribute('style', $styleListLink);
						}
					}
					break;
					case 20: {

						foreach ($html->find('.more-link') as $element) {
							$styleListLink = $element->getAttribute('style');
							$styleListLink .= 'text-shadow: 0 1px 1px #' . $value . ';';
							$element->setAttribute('style', $styleListLink);
						}
					}

					break;
				}
			}
		} else {

			switch ($_POST['link']) {
				case 'titleTextShadowLink': {
					foreach ($html->find('h1') as $element) {
						$titleTextShadowLink = $element->getAttribute('style');
						$titleTextShadowLink .= 'text-shadow: none;';
						$element->setAttribute('style', $titleTextShadowLink);
					}
				}
				break;
				case 'titleBorderLink': {
					foreach ($html->find('div[data-role="header"]') as $element) {
						$titleBorderLink = $element->getAttribute('style');
						$titleBorderLink .= 'border: 1px solid #333;';
						$element->setAttribute('style', $titleBorderLink);
					}
				}
				break;
				case 'iconTextShadowLink': {
					foreach ($html->find('a[data-icon="custom"]') as $element) {
						$iconTextShadowLink = $element->getAttribute('style');
						$iconTextShadowLink .= 'text-shadow: none;';
						$element->setAttribute('style', $iconTextShadowLink);
					}
				}
				break;
				case 'buttonBorderLink': {
					foreach ($html->find('a[data-role="button"]') as $element) {
						$buttonBorderLink = $element->getAttribute('style');
						$buttonBorderLink .= 'border: none;';
						$element->setAttribute('style', $buttonBorderLink);
					}
				}

				break;
				case 'buttonTextShadowLink': {

					foreach ($html->find('a[data-role="button"]') as $element) {

						$buttonTextShadowLink = $element->getAttribute('style');

						$buttonTextShadowLink .= 'text-shadow: none;';

						$element->setAttribute('style', $buttonTextShadowLink);
					}
				}

				break;

				case 'listsLinkTextShadowLink': {

					foreach ($html->find('.more-link') as $element) {

						$listsLinkTextShadowLink = $element->getAttribute('style');

						$listsLinkTextShadowLink .= 'text-shadow: none;';

						$element->setAttribute('style', $listsLinkTextShadowLink);
					}
				}

				break;
			}
		}

		$current = (string) $html;
		echo $myFile;
		echo file_put_contents($myFile, $current);
	}

	public function actionGetFeedContent()
	{


		$content = file_get_contents($_POST['feed']);

		$x = new SimpleXmlElement($content);


		echo '<ul>';


		foreach ($x->channel->item as $entry) {

			echo "
			<li>
			<h2><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></h2>
					<p>" . $entry->description . "</p>
							</li>";
		}
		echo "</ul>";
	}

	public function actionMytest() 
	{
	
		$app_id = Yii::app()->user->getState('app_id');
		$photo_html = '';
		$app_model = Application::model()->findByPk($app_id);
		$upload_path = Yii::app()->basePath . "/../www/customize_module_preview/photos_files/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
		$upload_url = Yii::app()->getBaseUrl(true) . "/www/customize_module_preview/photos_files/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
		$dest_path = Yii::app()->basePath . "/../applications/" . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id . "/photos_files/images/full";
	
	
	
		if (isset($_REQUEST['remove'])) {
			if (file_exists($upload_path . '/' . $_REQUEST['remove'])) {
				echo json_encode(array('result' => unlink($upload_path . '/' . $_REQUEST['remove'])));
				exit;
			}
			$upload_path = $dest_path;
			if (file_exists($upload_path . '/' . $_REQUEST['remove'])) {
				echo json_encode(array('result' => unlink($upload_path . '/' . $_REQUEST['remove'])));
				exit;
			} else {
				echo json_encode(array('result' => "cant found file :" . $upload_path . '/' . $_REQUEST['remove']));
				exit;
			}
		}
	
		/* upload-pictures-begin */
		$images = CUploadedFile::getInstancesByName('images');
		if (!empty($images)) {
			if (!is_dir($upload_path))
				mkdir($upload_path, 0755);
			if ($model->images)
				$this->deleteDirectory($model->images);
			$model->images = $upload_path;
			foreach ($images as $image => $pic) {
				$pic->saveAs($upload_path . '/' . $pic->name);
				$file = $upload_url . '/' . $pic->name;
				$photo_html .= '<li>
						<a href="javascript:;" class="image_click" style="position: relative">
						<span style="
						position: absolute;
						left: 45%;
						top: 29%;
						background: gray;
						border-radius: 13px;
						width: 20px;
						height: 20px;
						text-align: center;
						line-height: 20px;
						font-size: 10px;
						opacity: 0.8;
						color: white;
						border: 1px solid;
						">X</span>
						<img src="' . $file . '" alt="' . $pic->name . '" /></a></li>';
			}
			if (strcmp($photo_html, $_REQUEST['Module']['description']) != 0) {
				$photo_html = $_REQUEST['Module']['description'] . $photo_html;
			}
		}
		echo json_encode(array('photo_html' => $photo_html, 'upload_url' => $upload_path));
		exit;
	}
	
	private function prd($arg)
	{
		die(print_r($arg,true));
	}
	
	private function pr($arg)
	{
		echo "<pre>" ; echo print_r($arg,true);
	}

	public function actionMytestzip()
	{
	
		$app_id = Yii::app()->user->getState('app_id');
		
		$app_model = Application::model()->findByPk($app_id);
		
		$param = $app_model;
		
		$myFileSource = Yii::getPathOfAlias('webroot') . '/applications/' . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
		
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/applications/' . $app_model->title.'.zip';
		
		$this->Zip($myFileSource, $myFileDesn); 
		
						
		$this->redirect(array('mytestzipapp'));
			
		//$this->render('mytestzip');
		
	}
	
	public function actionMytestzipapp()
	{
		
		
		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
			
		$app_id = Yii::app()->user->getState('app_id');
		$app_model = Application::model()->findByPk($app_id);
		
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/applications/' . $app_model->title.'.zip';
			
		$a_profile_model = AndroidProfile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
			
		$key = array();

		$app_info = $phone->uploadAppFile($myFileDesn, $app_model->title, 'file');
		//echo "<pre>"; print_r($app_info); die;
		if ($app_info)
		{
			$app_model->pg_appid = $app_info;
				
			$app_model->update();
			
			$this->redirect(array('details'));
				
		} else {
				
			Yii::app()->user->setFlash('create_app_error', 'Some Error in Phone gap build');
				
			$this->redirect(array('details'));
		}
	}
}
