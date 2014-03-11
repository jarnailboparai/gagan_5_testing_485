<?php

/**
 * This is the model class for table "applink".
 *
 * The followings are the available columns in table 'applink':
 * @property integer $id
 * @property integer $application_id
 * @property integer $phonegap_id
 * @property string $android
 * @property string $ios
 * @property string $created
 */
class Applink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Applink the static model class
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
		return 'applink';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, phonegap_id', 'numerical', 'integerOnly'=>true),
			array('android, ios, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, application_id, phonegap_id, android, ios, created', 'safe', 'on'=>'search'),
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
			'application_id' => 'Application',
			'phonegap_id' => 'Phonegap',
			'android' => 'Android',
			'ios' => 'Ios',
			'created' => 'Created',
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
		$criteria->compare('application_id',$this->application_id);
		$criteria->compare('phonegap_id',$this->phonegap_id);
		$criteria->compare('android',$this->android,true);
		$criteria->compare('ios',$this->ios,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
