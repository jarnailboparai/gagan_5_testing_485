<?php

/**
 * This is the model class for table "android_profile".
 *
 * The followings are the available columns in table 'android_profile':
 * @property integer $id
 * @property integer $user_id
 * @property string $android_keystore_name
 * @property string $android_keystore_password
 * @property string $android_file_keystore
 * @property integer $phonegap_id
 */
class AndroidProfile extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return AndroidProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'android_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, android_keystore_name, android_keystore_password', 'required'),
            array('user_id, phonegap_id,application_id', 'numerical', 'integerOnly' => true),
            array('android_keystore_password', 'length', "min" => 6),
            array('android_keystore_name, android_keystore_password, android_file_keystore', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, android_keystore_name, android_keystore_password, android_file_keystore, phonegap_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        		'application' => array(self::BELONGS_TO, 'Application', 'application_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'android_keystore_name' => 'Android Keystore Name',
            'android_keystore_password' => 'Android Keystore Password',
            'android_file_keystore' => 'Android File Keystore',
            'phonegap_id' => 'Phonegap',
        	'application_id' => 'Application',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('android_keystore_name', $this->android_keystore_name, true);
        $criteria->compare('android_keystore_password', $this->android_keystore_password, true);
        $criteria->compare('android_file_keystore', $this->android_file_keystore, true);
        $criteria->compare('phonegap_id', $this->phonegap_id);
        $criteria->compare('application_id', $this->application_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
