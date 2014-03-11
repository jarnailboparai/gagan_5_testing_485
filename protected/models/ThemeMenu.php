<?php

/**
 * This is the model class for table "gcm".
 *
 * The followings are the available columns in table 'gcm':
 * @property integer $id
 * @property integer $theme_id
 * @property enum 	 $type
 * @property string  $css_file
 * @property string  $html_file
 * @property enum    $features
 * @property string  $image
 * 
 */
class ThemeMenu extends CActiveRecord
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
		return 'theme_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('app_id', 'numerical', 'integerOnly'=>true),
			//array('gcm_regid', 'length', 'max'=>512),
			//array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, theme_id, type, features', 'safe', 'on'=>'search'),
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
				'themefile' => array(self::BELONGS_TO, 'Theme', 'theme_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'theme_id' => 'theme_id',
			'type' => 'Type',
			'css_file' => ' Css File',
			'html_file' => 'Html File',
			'features' => 'Features',
			'image' => 'Image'
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
		$criteria->compare('theme_id',$this->theme_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('features',$this->features);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
