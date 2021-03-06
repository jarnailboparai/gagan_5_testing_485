<?php

class TrainingController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    
	public function beforeAction($action) {
	   $this->layout = '//layouts/column1';
	   return parent::beforeAction($action);
   }
   
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
	
	
}
