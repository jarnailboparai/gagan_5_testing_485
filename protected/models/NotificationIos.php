<?php

/**
 * This is the model class for table "notification_ios".
 *
 * The followings are the available columns in table 'notification_ios':
 * @property integer $id
 * @property integer $user_id
 * @property integer $app_id
 * @property integer $certification_push_pem_path
 * @property string $password
 */
class NotificationIos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationIos the static model class
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
		return 'notification_ios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, app_id', 'required'),
			array('user_id, app_id, certification_push_pem_path', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, app_id, certification_push_pem_path, password', 'safe', 'on'=>'search'),
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
			'certification_push_pem_path' => 'Certification Push Pem Path',
			'password' => 'Password',
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
		$criteria->compare('certification_push_pem_path',$this->certification_push_pem_path);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
