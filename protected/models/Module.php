<?php

/**
 * This is the model class for table "modules".
 *
 * The followings are the available columns in table 'modules':
 * @property integer $id
 * @property integer $application_id
 * @property string $name
 * @property string $keyword
 * @property string $tab_title
 * @property string $tab_icon
 * @property string $description
 * @property string $flickr_id
 * @property string $username
 * @property string $image
 * @property string $image_position
 * @property string $web_page_url
 * @property string $contact_form_subject
 * @property string $form_submit_email
 * @property string $submit_button_label
 * @property integer $number_of_fields
 * @property string $twitter_keyword
 * @property string $flickr_keyword
 * @property string $youtube_keyword
 * @property string $rss_feed_url
 * @property integer $module_order
 * @property string $activated
 *
 * The followings are the available model relations:
 * @property FormFields[] $formFields
 * @property Applications $application
 */
class Module extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Module the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, name, activated', 'required'),
			array('application_id, number_of_fields, module_order', 'numerical', 'integerOnly'=>true),
			array('name, keyword, tab_title, submit_button_label, twitter_keyword', 'length', 'max'=>50),
			array('tab_icon, image, web_page_url, form_submit_email, rss_feed_url', 'length', 'max'=>255),
			array('flickr_id, username, contact_form_subject', 'length', 'max'=>100),
			array('image_position', 'length', 'max'=>10),
			array('flickr_keyword, youtube_keyword', 'length', 'max'=>150),
			array('activated,page_type', 'length', 'max'=>3),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, application_id, name, keyword, tab_title, tab_icon, description, flickr_id, username, image, image_position, web_page_url, contact_form_subject, form_submit_email, submit_button_label, number_of_fields, twitter_keyword, flickr_keyword, youtube_keyword, rss_feed_url, module_order, activated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'formFields' => array(self::HAS_MANY, 'FormFields', 'module_id'),
			'subModules' => array(self::HAS_MANY, 'SubModules', 'module_id'),
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'application_id' => 'Application',
			'name' => 'Name',
			'keyword' => 'Keyword',
			'tab_title' => 'Tab Title',
			'tab_icon' => 'Tab Icon',
			'description' => 'Description',
			'flickr_id' => 'Flickr',
			'username' => 'Username',
			'image' => 'Image',
			'image_position' => 'Image Position',
			'web_page_url' => 'Web Page Url',
			'contact_form_subject' => 'Contact Form Subject',
			'form_submit_email' => 'Form Submit Email',
			'submit_button_label' => 'Submit Button Label',
			'number_of_fields' => 'Number Of Fields',
			'twitter_keyword' => 'Twitter Keyword',
			'flickr_keyword' => 'Flickr Keyword',
			'youtube_keyword' => 'Youtube Keyword',
			'rss_feed_url' => 'Rss Feed Url',
			'module_order' => 'Module Order',
			'activated' => 'Activated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('tab_title',$this->tab_title,true);
		$criteria->compare('tab_icon',$this->tab_icon,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('flickr_id',$this->flickr_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('image_position',$this->image_position,true);
		$criteria->compare('web_page_url',$this->web_page_url,true);
		$criteria->compare('contact_form_subject',$this->contact_form_subject,true);
		$criteria->compare('form_submit_email',$this->form_submit_email,true);
		$criteria->compare('submit_button_label',$this->submit_button_label,true);
		$criteria->compare('number_of_fields',$this->number_of_fields);
		$criteria->compare('twitter_keyword',$this->twitter_keyword,true);
		$criteria->compare('flickr_keyword',$this->flickr_keyword,true);
		$criteria->compare('youtube_keyword',$this->youtube_keyword,true);
		$criteria->compare('rss_feed_url',$this->rss_feed_url,true);
		$criteria->compare('module_order',$this->module_order);
		$criteria->compare('activated',$this->activated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getContents($appId)
	{
		$command = Yii::app()->db->createCommand();
		
		$command->select('name,tab_title,description');	
		$command->from($this->tableName());
		$command->where("application_id='".$appId."'");		
		$results = $command->queryAll();
		return $results;
	}
}
