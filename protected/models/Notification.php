<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property integer $user_id
 * @property integer $app_id
 * @property string $name
 * @property string $email
 * @property string $sender_id
 * @property string $created_at
 * @property string $google_api_key
 * @property string $certification_push_pem_path
 * @property string $apn_mobileprovision
 * @property string $phonegap_key_id
 */
class Notification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Notification the static model class
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
		return 'notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id', 'required'),
			array('user_id, app_id', 'numerical', 'integerOnly'=>true),
			array('name, certification_push_pem_path, apn_mobileprovision, phonegap_key_id', 'length', 'max'=>64),
			array('email', 'length', 'max'=>128),
			array('sender_id, google_api_key', 'length', 'max'=>255),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, app_id, name, email, sender_id, created_at, google_api_key, certification_push_pem_path, apn_mobileprovision, phonegap_key_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'app_id' => 'App',
			'name' => 'Name',
			'email' => 'Email',
			'sender_id' => 'Sender',
			'created_at' => 'Created At',
			'google_api_key' => 'Google Api Key',
			'certification_push_pem_path' => 'Certification Push Pem Path',
			'apn_mobileprovision' => 'Apn Mobileprovision',
			'phonegap_key_id' => 'Phonegap Key',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('google_api_key',$this->google_api_key,true);
		$criteria->compare('certification_push_pem_path',$this->certification_push_pem_path,true);
		$criteria->compare('apn_mobileprovision',$this->apn_mobileprovision,true);
		$criteria->compare('phonegap_key_id',$this->phonegap_key_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
