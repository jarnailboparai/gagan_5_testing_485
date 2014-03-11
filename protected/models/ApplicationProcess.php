<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ApplicationProcess extends CFormModel implements IECartPosition 
{
	public $menu;
	public $feature;
	public $name;
	public $appid;
	public $icon_app;
	public $video;
	public $image;
	public $media;
	public $splashscreen;
	public $android;
	public $isNewRecord;
	public $destination;
	public $source;
	public $zipcode;
	public $theme;
	public $theme_id;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			//array('layout, product_id, image, wrap_type', 'required'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'menu'=>'Menu ',
			'features'=>'Feature',
			'name'=>'Name',
			'appid'=>'App id',
			'icon_app'=>'Icon',
			'video'=>'Video',
			'image'=>'Image',
			'media'=>'Media',
			'splashscreen'=>'Splash Scree',
			'android'=>'Android',
			'theme'	 => 'Theme',
			'theme_id' =>'Theme id',
		);
	}

	function getId(){
        return $this->appid;
    }

    function getMenu()
    {
    	return $this->menu;
    }
    
    function getFeature()
    {
    	return $this->feature;
    }
    
    function getName()
    {
    	return $this->name;
    }
    
    public function onBeforeSave($event) {
    	//$pass = md5($this->usr_pass);
    	//$this->usr_pass= $pass;
    
    	//   $this->usr_pass=md5( $this->usr_pass);
    	//  $this->password_repeat=md5( $this->password_repeat);
    	//  die( $this->usr_pass);
    	return true;
    
    }
    
    public function onAfterSave($event) {
    	//$pass = md5($this->usr_pass);
    	//$this->usr_pass= $pass;
    
    	//   $this->usr_pass=md5( $this->usr_pass);
    	//  $this->password_repeat=md5( $this->password_repeat);
    	//  die( $this->usr_pass);
    	return true;
    
    }
    
    public function onBeforeDelete($event)
    {
    	return true;
    	
    }
    
    
    public function onAfterDelete($event)
    {
    	return true;
    	 
    }
    
    
    public function onBeforeFind()
    {
    	return true;
    }
    
    public function onAfterFind()
    {
    	return true;
    }
    
}
