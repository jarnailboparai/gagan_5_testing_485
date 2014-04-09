<?php


class ThemeSettingBackground extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VideoFiles the static model class
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
		return 'theme_setting_background';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('id, app_id, media_files_id,module_id,sub_module_id,port_media_id,land_media_id,color, created, updated', 'safe', 'on'=>'search'),
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
				'filemediaImageland' => array(self::BELONGS_TO, 'MediaFiles', 'land_media_id'),
				'filemediaImageport' => array(self::BELONGS_TO, 'MediaFiles', 'port_media_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App Id',
			'media_files_id' => 'Media Files Id',
			'module_id' => 'Module ID',
			'sub_module_id' => 'Sub Module Id',
			'port_media_id' => 'Port Media Id',
			'land_media_id' => 'Land Media Id',
			'color' => 'Color',
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('media_files_id',$this->media_files_id,true);
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('sub_module_id',$this->sub_module_id,true);
		$criteria->compare('port_media_id',$this->port_media_id,true);
		$criteria->compare('land_media_id',$this->land_media_id,true);
		$criteria->compare('color',$this->color,true);	
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
