<?php

/**
 * This is the model class for table "aweberusers".
 *
 * The followings are the available columns in table 'aweberusers':
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $tokensecret
 * @property integer $awerberapplication
 * @property string $created
 * @property string $updated
 */
class Aweberusers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Aweberusers the static model class
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
		return 'aweberusers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, awerberapplication', 'numerical', 'integerOnly'=>true),
			array('token, tokensecret', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, token, tokensecret, awerberapplication, created, updated', 'safe', 'on'=>'search'),
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
			'token' => 'Token',
			'tokensecret' => 'Tokensecret',
			'awerberapplication' => 'Awerberapplication',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('token',$this->token,true);
		$criteria->compare('tokensecret',$this->tokensecret,true);
		$criteria->compare('awerberapplication',$this->awerberapplication);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
