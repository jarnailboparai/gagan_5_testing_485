<?php

/**
 * This is the model class for table "leads".
 *
 */
class Lead extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Gcm the static model class
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
		return 'leads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
			//	'listdata'    => array(self::BELONGS_TO, 'Aweberlisting', 'list_id'),
				'listdata' => array(self::BELONGS_TO, 'Aweberlisting', '', 'on'=>'listdata.list_id = t.list_id'),
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
			'module_id' => 'Module',
			'module_name' => 'Module Name',
			'list_id'=>'List ID',
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('module_name',$this->module_name,true);
		$criteria->compare('list_id',$this->list_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function lead_data($data)
	{
		$this->app_id = $data['app_id'];
		$this->name = $data['name'];
		$this->user_id = $data['user_id'];
		$this->email = $data['email'];
		$this->module_id = $data['module_id'];
		$this->module_name = $data['module_name'];
		$this->list_id = $data['list_id'];
		$this->created = date('Y-m-d H:i:s');
		$this->save();
	}
	
	
	public function lead_count($app_id)
	{
		return 	$count = Lead::model()->countByAttributes(array(
	            'app_id'=> $app_id
	        ));
		
	}
}
