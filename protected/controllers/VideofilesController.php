<?php

class VideoFilesController extends Controller
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
	
// 	public function beforeAction()
// 	{
// 		if(isset($layout)){
// 			$this->layout = false;
// 		}
		
// 	}

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
				'actions'=>array('create','update','youtubelist','selectvideotype','selectvideos','imagelistthumb','nameedit'),
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
	public function actionCreate($layout=null,$module_id=null)
	{
		$model=new VideoFiles;
		
		if(isset($layout)){
			$this->layout = false;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VideoFiles']))
		{
			//print_r($_POST); die;
			$model->attributes=$_POST['VideoFiles'];
			$model->user_id = Yii::app()->user->id;
			$model->type = 2;
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id));
				$modelSub = new SubModules();
				$modelSub->module_id = $_POST['module_id'];
				$modelSub->video_files_id = $model->id;
				$modelSub->activated = 'yes';
				$modelSub->name = 'video';
				$modelSub->save();
				
				$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$_POST['module_id']));
				
				echo $this->renderPartial('//videofiles/_videolist' ,array("dataProvider"=>$dataSelectedImages));
				
				die;
				
				echo json_encode(array('sucess'=>1)); Yii::app()->end();
			}else{
				echo json_encode($model->errors); Yii::app()->end();		
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'module_id'=>$module_id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=null,$module_id=null,$layout=null)
	{
		$model=$this->loadModel($id);
		
		if(isset($layout)){
			$this->layout = false;
		}
		
		//$model = VideoFiles::model()->findAllByAttributes(array('id'=>$id));
		
		//echo "<pre>"; CVarDumper::dump($model); 
		//die;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VideoFiles']))
		{
			$model->attributes=$_POST['VideoFiles'];
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id));
				echo json_encode(array('success'=>1));
				Yii::app()->end();
			}else{ 
				CVarDumper::dump($model->error);
				Yii::app()->end();
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'module_id'=>$module_id,
			
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
		$model=new VideoFiles;
		
		if(isset($layout)){
			$this->layout = false;
		}
		
		$selected = array();
		if(isset($module_id)) {
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$module_id));
				
			foreach ($dataSelectedImages as $image){
		
				$selected[$image->attributes['id']] =  $image->attributes['video_files_id'];
				//print_r($image->filemedia->attributes['id']);
			}
				
		}
		$dataProvider = VideoFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'type'=>1));
		$dataProviderCustom = VideoFiles::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'type'=>2));
		
		//$fileUrl = Yii::app()->baseUrl.'/mediafiles/'.Yii::app()->user->getState('username').'_'.Yii::app()->user->id.'/thumb/';
		
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
			//	'fileUrl'=>$fileUrl,
				'module_id'=>$module_id,
				'selected' =>$selected,
				'dataProviderCustom'=>$dataProviderCustom,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VideoFiles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VideoFiles']))
			$model->attributes=$_GET['VideoFiles'];
			

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
		$model=VideoFiles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-files-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionYoutubelist($layout=null,$module_id=null)
	{
		if(isset($layout)){
			$this->layout = false;
		}
		
		if(isset($_POST['selectedlisted'])){
			//echo "<pre>"; //print_r($_POST[selectedlisted]); 
			foreach($_POST['selectedlisted'] as $selectdd)
			{
				//print_r(json_decode($selectdd));
				$select = json_decode($selectdd);
				//print_r($select);
				$model=new VideoFiles;
				
				if(is_object($select->id))
				{
					$videoId = $select->id->videoId;
				}else{
					$videoId = $select->snippet->resourceId->videoId;
				}
				
// 				if(is_object($select->snippet->resourceId->videoId))
// 				{
// 					$videoId = $select->snippet->resourceId->videoId;
// 				}
				
				$model->user_id = Yii::app()->user->id;
				
				$model->title = mb_convert_encoding($select->snippet->title, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->description= mb_convert_encoding( $select->snippet->description, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->thumbnail_url = mb_convert_encoding(  $select->snippet->thumbnails->high->url, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->threegp_url = mb_convert_encoding($videoId, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->mp4_url = mb_convert_encoding( $videoId, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->m4v = mb_convert_encoding( $videoId, 'HTML-ENTITIES', 'ISO-8859-1');
				
				$model->actual_url =mb_convert_encoding( $videoId, 'HTML-ENTITIES', 'ISO-8859-1');
				
				//echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $string);
				
				
				//htmlentities($html, ENT_COMPAT | ENT_HTML401, 'ISO-8859-1');
				$model->type = 1;
				
				//print_r($model->attributes);
				
				//$model->save();
				
				//$model->
				

				if($model->save())
				{
					$modelSub = new SubModules();
					$modelSub->module_id = $_POST['module_id'];
					$modelSub->video_files_id = $model->id;
					$modelSub->activated = 'yes';
					$modelSub->name = 'video';
					$modelSub->save();
					

					
				}else{
					//CVarDumper::dump($model->errors,10,true);
				}
			}
			
			$dataSelectedImages  = SubModules::model()->findAllByAttributes(array('module_id'=>$_POST['module_id']));
				
			echo $this->renderPartial('//videofiles/_videolist' ,array("dataProvider"=>$dataSelectedImages));
				
			die;
			
			echo json_encode(array("success"=>'Done '));
			
			Yii::app()->end();
			//print_r($_POST['selectedlisted']); die;
		}
		$this->render('youtubelist',array('module_id'=>$module_id));
	}
	
	public function actionSelectvideotype($layout=null,$module_id=null)
	{
		//selectvideotype.php
		if(isset($layout)){
			$this->layout = false;
		}
		$this->render('selectvideotype',array('module_id'=>$module_id));
	}
	
	public function actionSelectvideos()
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
					$model->video_files_id = $select;
					$model->activated = 'yes';
					$model->name = 'video';
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
				
			echo $this->renderPartial('//videofiles/_videolist' ,array("dataProvider"=>$dataSelectedImages));
				
			die;
		}
	}
	
	public function actionNameedit()
	{
		if(isset($_POST['VideoFiles']))
		{
			//$model=new MediaFiles;
			//print_r($_POST['VideoFiles']); die;
			$model = VideoFiles::model()->findByAttributes(array('id'=>$_POST['VideoFiles']['id']));
			
			$model->title = $_POST['VideoFiles']['name'];
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
}