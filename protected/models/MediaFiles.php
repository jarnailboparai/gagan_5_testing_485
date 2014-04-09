<?php

/**
 * This is the model class for table "media_files".
 *
 * The followings are the available columns in table 'media_files':
 * @property integer $id
 * @property string $filename
 * @property integer $user_id
 * @property string $original_name
 * @property string $type
 * @property string $size
 * @property string $extension
 * @property string $created
 * @property string $updated
 */
class MediaFiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MediaFiles the static model class
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
		return 'media_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, user_id, original_name, type, size, extension', 'required'),
			array('user_id, flag', 'numerical', 'integerOnly'=>true),
			array('filename, original_name, type, size, extension', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, filename, user_id, original_name, type, size, extension, created, updated', 'safe', 'on'=>'search'),
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
				//'sub_medias' => array(self::BELONGS_TO, 'SubModules', 'media_files_id'),
				//'filemedia' => array(self::HAS_ONE, 'SubModules', 'media_files_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'filename' => 'Filename',
			'user_id' => 'User',
			'original_name' => 'Original Name',
			'type' => 'Type',
			'size' => 'Size',
			'extension' => 'Extension',
			'flag'	=> 'Flag',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('original_name',$this->original_name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
