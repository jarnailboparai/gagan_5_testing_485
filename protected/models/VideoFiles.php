<?php

/**
 * This is the model class for table "video_files".
 *
 * The followings are the available columns in table 'video_files':
 * @property integer $id
 * @property string $actual_url
 * @property string $mp4_url
 * @property string $threegp_url
 * @property string $m4v
 * @property string $thumbnail_url
 * @property string $title
 * @property string $description
 * @property string $created
 * @property string $updated
 */
class VideoFiles extends CActiveRecord
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
		return 'video_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actual_url, mp4_url, threegp_url, m4v, thumbnail_url, title, description', 'required'),
			array('actual_url, mp4_url, threegp_url, m4v, thumbnail_url, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, actual_url, mp4_url, threegp_url, m4v, thumbnail_url, title, description, created, updated', 'safe', 'on'=>'search'),
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
				'filemediaImage' => array(self::BELONGS_TO, 'MediaFiles', 'thumbnail_url'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'actual_url' => 'Actual Url',
			'mp4_url' => 'Mp4 Url',
			'threegp_url' => 'Threegp Url',
			'm4v' => 'M4v',
			'thumbnail_url' => 'Thumbnail Url',
			'title' => 'Title',
			'description' => 'Description',
			'created' => 'Created',
			'updated' => 'Updated',
			'type'=>'Type'
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
		$criteria->compare('actual_url',$this->actual_url,true);
		$criteria->compare('mp4_url',$this->mp4_url,true);
		$criteria->compare('threegp_url',$this->threegp_url,true);
		$criteria->compare('m4v',$this->m4v,true);
		$criteria->compare('thumbnail_url',$this->thumbnail_url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
