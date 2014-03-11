<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $creation_time
 */
class User extends CActiveRecord
{
    
        const ROLE_ADMIN = 'admin';
        const ROLE_USER = 'Authenticated';
    
        // holds the password confirmation word
        public $repeat_password;

        //will hold the encrypted password for update actions.
        public $initialPassword;
        
        //used to agree agreement
        public $iagree;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, first_name, last_name, membership_type, payment_system', 'required'),
			array('username, email, password', 'length', 'max'=>255),
                        array('password, repeat_password', 'required', 'on'=>'create'),
                        array('password, repeat_password', 'length', 'min'=>6, 'max'=>40),
                        array('password', 'compare', 'compareAttribute'=>'repeat_password'),
                        array('iagree', 'compare', 'compareValue' => true, 'message' => 'You must agree to the terms and conditions' ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, first_name, last_name, email, password, creation_time, membership_type, payment_system', 'safe', 'on'=>'search'),
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
				'appioskey' => array(self::HAS_ONE, 'AppleProfile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
                        'first_name' => 'First name',
                        'last_name' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
                        'repeat_password' => 'Repeat Password',
			'creation_time' => 'Creation Time',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('creation_time',$this->creation_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {
            // in this case, we will use the old hashed password.
            if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
                $this->password=$this->repeat_password=$this->initialPassword;
            else
                $this->password=md5($this->password);

            return parent::beforeSave();
        }
        
        public function afterFind()
        {
            //reset the password to null because we don't want the hash to be shown.
            $this->initialPassword = $this->password;
            //$this->password = null;

            parent::afterFind();
        }
}
