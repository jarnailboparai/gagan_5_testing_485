<?php

/**
 * This is the model class for table "applications".
 *
 * The followings are the available columns in table 'applications':
 * @property integer $id
 * @property string $id_app
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $icon
 * @property integer $android
 * @property integer $iphone
 * @property string $launch_tab_title
 * @property string $phone_title
 * @property string $phone
 * @property string $email_title
 * @property string $email
 * @property string $address_title
 * @property string $address
 * @property string $launch_image
 * @property string $master_keyword
 * @property string $master_address
 * @property string $build
 * @property integer $app_type
 * @property string $git_repo_url
 * @property integer $notifications
 * @property integer $pg_appid
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Build[] $builds
 * @property Modules[] $modules
 */
class Application extends CActiveRecord {

    public $new_icon;
    public $new_launch_image;

    /**
     * Returns the static model of the specified AR class.
     * @return Application the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'applications';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('user_id, title ,id_app, description, icon, build', 'required'),
        		array('user_id, title ,id_app, description, icon', 'required'),
            array(
			  'title', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z0-9]/',
			  'message' => 'App title must consist of Alphanumeric characters .'),
		    array('app_type, notifications', 'safe'),
            array('launch_tab_title, launch_image', 'required', 'on' => 'splash'),
            array('user_id, android, iphone', 'numerical', 'integerOnly' => true),
            array('title, icon, launch_tab_title, phone, email, address, launch_image, master_address', 'length', 'max' => 255),
            array('phone_title, email_title, address_title', 'length', 'max' => 30),
            array('master_keyword', 'length', 'max' => 100),
            array('icon', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => 'true'),
            array('launch_image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => 'true'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, id_app, user_id, title, description, icon, android, iphone, launch_tab_title, phone_title, phone, email_title, email, address_title, address, launch_image, master_keyword, master_address, build, app_type, git_repo_url, notifications, pg_appid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        	'userss' => array(self::BELONGS_TO, 'User', 'user_id'),
            'modules' => array(self::HAS_MANY, 'Modules', 'application_id'),
        	'thememenu' => array(self::BELONGS_TO, 'ThemeMenu', 'theme_menu_id'),
        	'applinkdata' => array(self::HAS_ONE, 'Applink', 'application_id'),
        	'themesetting' => array(self::HAS_ONE, 'ThemeSettingBackground', 'app_id'),
        	
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_app' => 'Id App',
            'user_id' => 'User',
            'title' => 'Title',
            'description' => 'Description',
            'icon' => 'Icon',
            'android' => 'Android',
            'iphone' => 'Iphone',
            'launch_tab_title' => 'Launch Tab Title',
            'phone_title' => 'Phone Title',
            'phone' => 'Phone',
            'email_title' => 'Email Title',
            'email' => 'Email',
            'address_title' => 'Address Title',
            'address' => 'Address',
            'launch_image' => 'Launch Image',
            'master_keyword' => 'Master Keyword',
            'master_address' => 'Master Address',
            'build' => 'Build',
            'app_type' => 'App Type',
            'git_repo_url' => 'Git Repo Url',
            'notifications' => 'Notifications',
            'pg_appid' => 'Pg Appid',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_app', $this->id_app, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('icon', $this->icon, true);
        $criteria->compare('android', $this->android);
        $criteria->compare('iphone', $this->iphone);
        $criteria->compare('launch_tab_title', $this->launch_tab_title, true);
        $criteria->compare('phone_title', $this->phone_title, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email_title', $this->email_title, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('address_title', $this->address_title, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('launch_image', $this->launch_image, true);
        $criteria->compare('master_keyword', $this->master_keyword, true);
        $criteria->compare('master_address', $this->master_address, true);
        $criteria->compare('build', $this->build, true);
        $criteria->compare('app_type', $this->app_type);
        $criteria->compare('git_repo_url', $this->git_repo_url, true);
        $criteria->compare('notifications', $this->notifications);
        $criteria->compare('pg_appid', $this->pg_appid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
