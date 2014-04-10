<?php

/**
 * This is the model class for table "aweberlisting".
 *
 * The followings are the available columns in table 'aweberlisting':
 * @property integer $id
 * @property integer $aweberapplication_id
 * @property integer $list_id
 * @property string $name
 * @property string $created
 * @property string $updated
 */
class Aweberlisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Aweberlisting the static model class
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
		return 'aweberlisting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aweberapplication_id, list_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aweberapplication_id, list_id, name, created, updated', 'safe', 'on'=>'search'),
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
			'aweberapplication_id' => 'Aweberapplication',
			'list_id' => 'List',
			'name' => 'Name',
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
		$criteria->compare('aweberapplication_id',$this->aweberapplication_id);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
