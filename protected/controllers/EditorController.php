<?php

class EditorController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionTraining()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$request = Yii::app()->request;
		$id = $request->getQuery('id');
		$child_items = array();
		if ($id){
			$model = Pages::model()->findByPk($id);
			if ($model->parent)
				$child_items = Pages::model()->findAll('parent='.$model->parent);
		} else {
			$model = new Pages;
		}
		
		$user = Yii::app()->user;
		$role = $user->getRole();
		if($role != 'admin'){
			$url=$this->createUrl('site/training', array('id'=>$model->id));
			$this->redirect($url, true);
		}

		// collect user input data
		if ($request->getPost('Pages')){
			$params = $request->getPost('Pages');
			
			if(!isset($params['id']) && !isset($model->id)){
				$parent = Pages::model()->find('url_part="site/training"');
				$params['parent'] = $parent->id;
			}

			$model->attributes = $params;
			$model->save();
		}
		$this->render('training', array('model' => $model, 'pages' => $child_items));
	}
	
	public function actionWelcome()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$request = Yii::app()->request;
		$id = $request->getQuery('id');
		$child_items = array();
		if ($id){
			$model = Pages::model()->findByPk($id);
			if ($model->parent)
				$child_items = Pages::model()->findAll('parent='.$model->parent);
		} else {
			$model = new Pages;
		}
		
		$user = Yii::app()->user;
		$role = $user->getRole();
		if ($role != 'admin'){
			$url=$this->createUrl('site/training', array('id'=>$model->id));
			$this->redirect($url, true);
		}
		
		// collect user input data
		if ($request->getPost('Pages')){
			$params = $request->getPost('Pages');
			//var_dump($params);var_dump($model->id);die;
			if (!isset($params['id']) && !isset($model->id)){
				$parent = Pages::model()->find('url_part="site/welcome"');
				$params['parent'] = $parent->id;
			}

			$model->attributes = $params;
			if ($model->save()){
				$url = Yii::app()->createUrl('editor/welcome', array('id'=>$model->id));
				$this->redirect($url, true);
			}
		}
		$this->render('welcome', array('model' => $model, 'pages' => $child_items));
	}
	
	public function actionDelete(){
		$request = Yii::app()->request;
		$id = $request->getQuery('id');
		if ($id){
			$model = Pages::model()->findByPk($id);
			$parentid = $model->parent;
			
			if ($parentid){
				$parent =  Pages::model()->findByPk($parentid);
				
				if ($model->delete()){
					$this->redirect(array($parent->url_part), true);
				}
			}

		}
	}
}
