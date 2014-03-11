<?php
Yii::import('application.vendors.*');
require_once 'phonagap.php';

class ThemeController extends Controller
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
	
	public function beforeAction($action)
	{
		$this->layout = '//layouts/column2';
		return parent::beforeAction($action);
	}
	
	public function allowedActions()
	{
		return 'createFolderRecur,index,theme,slider,error,selectfeature,createapp,buildapp,modifyfeature,mytestzip,mytestzipapp';
	}
	
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionIndex()
	{
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
			
			//echo "<br/>";
		}
		
		//echo "<pre>"; print_r($slider); print_r($modeldata);
		$modelApp=new ApplicationProcess();
		Yii::app()->applicationselect->clear();
		if(isset($_POST['ApplicationProcess']))
		{
			Yii::app()->applicationselect->clear();
				
			$modelApp->theme = $_POST['ApplicationProcess']['theme'];
			$modelApp->theme_id = $_POST['ApplicationProcess']['theme_id'];
			$modelApp->name = $_POST['ApplicationProcess']['name'];
			$modelApp->appid = $_POST['ApplicationProcess']['appid'];
				
			Yii::app()->applicationselect->put($modelApp,1);
			//echo json_decode($model);
			$this->redirect(array('selectfeature'));
		}
		
		$this->render('index',array('adata'=>$modeldata,'slider'=>$slider,'model'=>$modelApp));
	}
	
	public function actionTheme()
	{
		//echo "theme";
		
		$this->render('theme');
	}
	
	public function actionSlider()
	{
		echo "slider";
		$this->render('slider');
	}
	
	public function actionCreateapp()
	{
		$models = Yii::app()->applicationselect;
		$model = $this->getModel($models);
		
		if(isset($_POST['ApplicationProcess']))
		{
				
			$model->menu = $_POST['ApplicationProcess']['menu'];
	
			Yii::app()->applicationselect->put($model,1);
				
			$this->createFileStructure();
	
			$this->redirect(array('selectfeature'));
	
		}
	
		$this->render('createapp',array('model'=>$model));
	}
	
	public function actionSelectfeature()
	{
		$modulefiles = ModuleFile::model()->findAll();
		
		$data =  array();
		foreach($modulefiles as $modulefile)
		{
			$data[$modulefile->id.'_'.$modulefile->title] =  $modulefile->title;
		}
		
		
		
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
		
		if(isset($_POST['ApplicationProcess']))
		{
	
			$this->createFileStructure();
			print_r($_POST['ApplicationProcess']['feature']);  die;
			$model->feature = $_POST['ApplicationProcess']['feature'];
	
			Yii::app()->applicationselect->put($model,1);
				
				
			$filearray = $_POST['ApplicationProcess']['feature'];
				
			$this->createFiles($filearray);
	
			$this->redirect(array('modifyfeature'));
	
		}
	
		$this->render('selectfeature',array('model'=>$model,'modulefiles'=>$modulefiles,'data'=>$data));
		//echo $model->menu;
	}
	
	public function actionModifyfeature()
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
		$this->render('modifyfeature',array('model'=>$model));
	}
	
	public function actionBuildApp()
	{
		$model = $this->gd();
	
		$this->createMenus();
	
		$this->render('buildapp' ,array('model'=>$model));
	
	}
	
	public function getModel($arg)
	{
		foreach($arg as $model)
		{
			$temp = $model;
		}
	
		return $model;
	}
	
	public function actionMytestzipapp()
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
	
		$phone = new PhoneagpApi(Yii::app()->params->phonegapUsername, Yii::app()->params->phonegapPassword);
	
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name.'.zip';
			
		$app_info = $phone->uploadAppFile($myFileDesn, $model->name, 'file');
	
		echo "<pre>"; print_r($app_info); die;
	
	}
	
	public function actionMytestzip()
	{
	
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
	
		$myFileSource = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name;
	
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name.'.zip';
	
		$this->Zip($myFileSource, $myFileDesn);
	
		//die;
	
		$this->render('mytestzip');
	
		// 		$this->redirect(array('mytestzipapp'));
			
	}
	
	private function Zip($source, $destination)
	{
	
		if (!extension_loaded('zip') || !file_exists($source)) {
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
	
	private function recurFolder($source,$myFileDesn,$pathd = true,$no = 1)
	{
		$stringF = "<div style='color:%s;' > %s >>> %s filename %s  %s </div>";
		if (is_dir($source) === true)
		{
	
			$iterator = new RecursiveDirectoryIterator($source);
			$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
				
			$files = new RecursiveIteratorIterator($iterator,RecursiveIteratorIterator::CATCH_GET_CHILD);
				
			if($pathd){
				if (!file_exists($myFileDesn))
					mkdir($myFileDesn);
			}
				
			foreach ($files as $file)
			{
	
				$file = str_replace('\\', '/', realpath($file));
	
				//echo count(explode('/',$file)).'<br/>';
				$path_parts = pathinfo($file);
	
				if (is_file($file) === true )
				{
	
					$filename = $path_parts['basename'];
					$pa = $myFileDesn.'/'.$filename;
						
					//printf($stringF,'red',$file,$pa,$filename,$no);
					copy($file,$pa);
						
				}else if (is_dir($file) === true) {
						
					$filename = $path_parts['basename'];
					$flag = false;
					$pa = $myFileDesn.'/'.$path_parts['basename'];
	
					if (!file_exists($pa))
						mkdir($pa);
					//printf($stringF,'green',$file,$pa,$filename,$no);
					$no = $no + 1;
					$this->recurFolder($file,$pa,false,$no);
	
				}
	
	
			}
				
			return true;
		}
	}
	
	private function changeFileContent($filename)
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
	
		$strConfig = implode("", file($filename)) ;
	
		//print_r($strConfig); die;
	
		$strConfig = str_replace('%NAME%', $model->name , $strConfig);
	
		$strConfig = str_replace('%ID%', "app.id.com", $strConfig);
	
		$strConfig = str_replace('%DESCRIPTION%', "TEST DESCRIPTION" , $strConfig);
	
		$strConfig = str_replace('%AUTHOR%', "TEST AUTHOR" , $strConfig);
	
		$strConfig = str_replace('%ICON%', "icon.jpg", $strConfig);
	
		$strConfig = str_replace('%SPLASH%', "splah.jpg", $strConfig);
	
		$fp = fopen($filename, 'w');
	
		fwrite($fp, $strConfig, strlen($strConfig));
	
	}
	
	private function createFileStructure()
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
	
		$source = Yii::getPathOfAlias('webroot') . '/demo';
	
		$sourcefile = Yii::getPathOfAlias('webroot') . '/demofeatures';
	
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name;
	
		$model->destination = $myFileDesn;
			
		Yii::app()->applicationselect->put($model,1);
	
		$this->recurFolder($source, $myFileDesn);
	
	
	}
	
	private function createFiles($files =  array())
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
	
		$sourcefile = Yii::getPathOfAlias('webroot') . '/demofeatures';
	
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name;
	
		$template = 'index.html';
		switch ($model->menu) {
			case 1:
				copy($sourcefile.'/leftside.html',$myFileDesn."/index.html");
				$template = "leftsidetemp.html";
				break;
			case 2:
				copy($sourcefile.'/rightside.html',$myFileDesn."/index.html");
				$template = "rightsidetemp.html";
				break;
			case 3:
				copy($sourcefile.'/onerow.html',$myFileDesn."/index.html");
				$template = "onerowtemp.html";
				break;
			case 4:
				copy($sourcefile.'/tworow.html',$myFileDesn."/index.html");
				$template = "tworowtemp.html";
				break;
			case 5:
				copy($sourcefile.'/threerow.html',$myFileDesn."/index.html");
				$template = "threerowtemp.html";
				break;
			case 6:
				copy($sourcefile.'/singleline.html',$myFileDesn."/index.html");
				$template = "singlelinetemp.html";
				break;
			default:
				copy($sourcefile.'/index.html',$myFileDesn."/index.html");
				$template = "index.html";
				break;
		}
	
	
		copy($sourcefile.'/config.xml',$myFileDesn."/config.xml");
	
		if(count($files))
		{
	
			foreach($files as $file){
					
				$so_file = $sourcefile.'/'.$template;
				$my_file = $myFileDesn.'/'.$file;
				copy($so_file,$my_file);
				//$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
	
			}
		}
	
		$this->changeFileContent($myFileDesn."/"."config.xml");
	
	}
	
	private function gd()
	{
		$models=Yii::app()->applicationselect;
		$model =  $this->getModel($models);
		return $model;
	}
	
	private function createMenus()
	{
		$model = $this->gd();
		$menus = $model->feature;
		//$menus[] = 'index.html';
		//echo "<pre>"; print_r($model);  die;
	
		$files = $menus;
	
		/* index */
	
		$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name;
			
		$filename  = $myFileDesn.'/'.'index.html';
			
		//$filename  = $myFileDesn.'/'.'index.html';
			
		$menuli = '';
	
		$i = 1;
	
		if($model->menu == 4)
		{
			foreach($menus as $menu)
			{
				$titlem = explode('.',basename($menu));
				$titlem[0] = strtoupper($titlem[0]);
				if( ($i % 2) == 1 )
					$menuli .= "<li class='ui-block-a'><a href='{$menu}' >{$titlem[0]}</a></li>";
				elseif(($i % 2) == 0)
				$menuli .= "<li class='ui-block-b'><a href='{$menu}' >{$titlem[0]}</a></li>";
				$i++;
			}
		}elseif($model->menu == 5){
			foreach($menus as $menu)
			{
				$titlem = explode('.',basename($menu));
				$titlem[0] = strtoupper($titlem[0]);
				if( ($i % 3) == 1 )
					$menuli .= "<li class='ui-block-a'><a href='{$menu}' >{$titlem[0]}</a></li>";
				elseif(($i % 3) == 2)
				$menuli .= "<li class='ui-block-b'><a href='{$menu}' >{$titlem[0]}</a></li>";
				elseif(($i % 3) == 0)
				$menuli .= "<li class='ui-block-c'><a href='{$menu}' >{$titlem[0]}</a></li>";
	
					
				$i++;
			}
		}else{
				
	
			foreach($menus as $menu)
			{
				$titlem = explode('.',basename($menu));
				$titlem[0] = strtoupper($titlem[0]);
				$menuli .= "<li><a href='{$menu}' >{$titlem[0]}</a></li>";
	
				$i++;
			}
	
		}
			
		$strConfig = implode("", file($filename)) ;
			
		//print_r($strConfig); die;
			
		$title = explode('.',basename($filename));
			
		$title[0] = strtoupper($title[0]);
			
		$strConfig = str_replace('%TITEL%', $title[0] , $strConfig);
	
		$strConfig = str_replace('%CONTENT%', '' , $strConfig);
	
		$strConfig = str_replace('%LISTMENUS%', $menuli , $strConfig);
			
		$fp = fopen($filename, 'w');
			
		fwrite($fp, $strConfig, strlen($strConfig));
	
		/* index end*/
	
	
		foreach($files as $file){
	
			//$myFileDesn  = Yii::getPathOfAlias('webroot') . '/zipdir/' .$model->name;
				
			$filename  = $myFileDesn.'/'.$file;
				
			//$filename  = $myFileDesn.'/'.'index.html';
				
			$menuli = '';
				
			foreach($menus as $menu)
			{
				$titlem = explode('.',basename($menu));
				$titlem[0] = strtoupper($titlem[0]);
				$menuli .= "<li><a href='{$menu}' >{$titlem[0]}</a></li>";
			}
				
			$strConfig = implode("", file($filename)) ;
				
			//print_r($strConfig); die;
				
			$title = explode('.',basename($filename));
				
			$title[0] = strtoupper($title[0]);
				
			$strConfig = str_replace('%TITEL%', $title[0] , $strConfig);
				
			$strConfig = str_replace('%CONTENT%', $title[0] , $strConfig);
				
			$strConfig = str_replace('%LISTMENUS%', $menuli , $strConfig);
				
			$fp = fopen($filename, 'w');
				
			fwrite($fp, $strConfig, strlen($strConfig));
		}
	}
	

}
