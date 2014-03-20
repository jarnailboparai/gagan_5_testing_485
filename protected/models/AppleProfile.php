<?php

/**
 * This is the model class for table "apple_profile".
 *
 * The followings are the available columns in table 'apple_profile':
 * @property integer $id
 * @property integer $user_id
 * @property string $apple_email
 * @property string $phone_gap_key_title
 * @property string $apple_p12_password
 * @property string $p12_file
 * @property string $store_provisioning_profile
 * @property integer $phonegap_id
 */
class AppleProfile extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return AppleProfile the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'apple_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required'),
            array('user_id, phonegap_id,application_id', 'numerical', 'integerOnly' => true),
            array('apple_email, phone_gap_key_title, p12_file, store_provisioning_profile', 'length', 'max' => 100),
            array('apple_p12_password', 'length', 'max' => 255),
            array('p12_file', 'type' ,'type' => 'p12'),
            array('store_provisioning_profile','type' ,'type' => 'mobileprovision'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, apple_email, phone_gap_key_title, apple_p12_password, p12_file, store_provisioning_profile, phonegap_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        		//'applicationprofile'=>''
        		'applicationprofile' => array(self::BELONGS_TO, 'Application', 'application_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'apple_email' => 'Apple Email',
            'phone_gap_key_title' => 'Phone Gap Key Title',
            'apple_p12_password' => 'Apple P12 Password',
            'p12_file' => 'P12 File',
            'store_provisioning_profile' => 'Store Provisioning Profile',
            'phonegap_id' => 'Phonegap',
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
        $criteria->compare('apple_email', $this->apple_email, true);
        $criteria->compare('phone_gap_key_title', $this->phone_gap_key_title, true);
        $criteria->compare('apple_p12_password', $this->apple_p12_password, true);
        $criteria->compare('p12_file', $this->p12_file, true);
        $criteria->compare('store_provisioning_profile', $this->store_provisioning_profile, true);
        $criteria->compare('phonegap_id', $this->phonegap_id);
        $criteria->compare('application_id', $this->application_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
