<?php

class AppsettingController extends Controller
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
				'actions'=>array('appinfo','apptheme','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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


	


	public function actionAppinfo()
	{
		$app_id = $_GET['id'];
		if ($app_id > 0) {
		
			Yii::app()->user->setState('app_id', $app_id);
			$model = Application::model()->findByPk($app_id);
		}
		
		if (isset($_POST['Application'])) {
				
			if (!$_POST['Application']['icon'])
				unset($_POST['Application']['icon']);
		
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
	
				Yii::app()->user->setFlash('success', "App Settings are Updated!");
				$this->redirect(array('appinfo','id'=>$app_id));
			}
			else {
				Yii::app()->user->setFlash('success', "Error! App Settings are not Updated");
				$this->redirect(array('appinfo','id'=>$app_id));
				
			}
		}
		
		$this->render('details',array('model'=>$model));

	}
	
	public function actionApptheme()
	{

		$app_id = Yii::app()->user->getState('app_id');
		$app_model = Application::model()->findByPk($app_id);
		
		// 		echo "index";
		$models = Theme::model()->findAll();
		
		$slider = array();
		
		$modeldata = array();
		foreach($models as $model)
		{
		
			//echo $model->name;
			$temp = array();
			foreach($model->menus as $menu)
			{
				//echo $menu->type.'<hr>';
				$temp[$menu->id] 	=	array('themeid'=>$menu->theme_id,'image'=>$menu->image,'id'=>$menu->id,'type'=>$menu->type,'features'=>$menu->features);
				if($menu->features)
				{
					$slider[] = array('themeid'=>$menu->theme_id,'image'=>$menu->image,'id'=>$menu->id,'type'=>$menu->type,'features'=>$menu->features);
				}
			}
		
			$modeldata[$model->id]	=	$temp;
		
			
		}
		
		$modelApp=new ApplicationProcess();
		Yii::app()->applicationselect->clear();
		if(isset($_POST['ApplicationProcess']))
		{
			
			$app_model->theme_menu_id = $_POST['ApplicationProcess']['theme'];
			if($app_model->save()){
				
				Yii::app()->applicationselect->clear();
		
				$modelApp->theme = $_POST['ApplicationProcess']['theme'];
				$modelApp->theme_id = $_POST['ApplicationProcess']['theme_id'];
				$modelApp->name = $_POST['ApplicationProcess']['name'];
				$modelApp->appid = $_POST['ApplicationProcess']['appid'];
		
				Yii::app()->applicationselect->put($modelApp,1);
				Yii::app()->user->setFlash('success', "App Settings are Updated!");
				$this->redirect(array('delete','id'=>$app_id));

			}
			else
			{
				Yii::app()->user->setFlash('success', "Error! App Settings are not Updated");
				$this->redirect(array('apptheme'));
			}
		}
		
	
		
		
		$this->render('theme',array('adata'=>$modeldata,'slider'=>$slider,'model'=>$modelApp,'app_model'=>$app_model));
	}
	
	
	//            test
	
	
	public function actionDelete($id)
	{	 
		$app_id = $id;
		//$this->removeFromPhoneGapBuild($app_id);
	
		$app_model = Application::model()->findByPk($app_id);
	
		$myFile = Yii::getPathOfAlias('webroot') . '/applications/' . Yii::app()->user->getState('username') . "_" . $app_model->title . "_" . $app_model->id;
	
		$this->deleteDirectory($myFile);
	
		/* * *****delete launch and icon images on app_images folder ****** */
		//$this->redirect(array('applicationnew/finalpreview')); 
				$this->redirect(array('applicationnew/finalpreview')); 

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
	
	
	
}

