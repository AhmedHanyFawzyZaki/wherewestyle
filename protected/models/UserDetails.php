<?php

/**
 * This is the model class for table "user_details".
 *
 * The followings are the available columns in table 'user_details':
 * @property integer $id
 * @property integer $user_id 
 * @property string $state
 * @property string $county
 * @property string $address
 * @property string $address2
 * @property string $zipcode
 * @property string $lng
 * @property string $lat
 * @property integer $zoom
 * @property string $created
 * @property string $last_login 
 * @property string $phone_no
 * @property string $fax_no
 * @property string $hear_from  
 * @property string $country_id
 * @property string $city 
 *
 * The followings are the available model relations:
 * @property User[] $users
 * @property PhoneType $phoneType
 */
class UserDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserDetails the static model class
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
		return '{{user_details}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, zoom', 'numerical', 'integerOnly'=>true),
			array('state, county, country_id, city', 'length', 'max'=>90),
			array('address, address2, lng, lat, phone_no, fax_no', 'length', 'max'=>255),
			array('zipcode', 'length', 'max'=>50),
			array('created, last_login ,v_company,trainer_status', 'safe'),

			array('zipcode','required','on'=>'traineredit'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, state, county, address, address2, zipcode, lng, lat, zoom, created, last_login, phone_no, fax_no, country_id, city', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'user_details_id'),			
			'UserCountry' => array(self::BELONGS_TO, 'Country', 'country_id'),						

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
			'state' => 'State',
			'county' => 'County',
			'address' => 'Address 1',
			'address2' => 'Address 2',
			'zipcode' => 'Zipcode',
			'lng' => 'Long',
			'lat' => 'Lat',
			'zoom' => 'Zoom',
			'created' => 'Created',
			'last_login' => 'Last Login',			
			'phone_no' => 'Phone No',
			'fax_no' => 'Fax No',							
			'country_id' => 'Country',
			'city' => 'City',			
			'v_company' => ' Company Name ',
			'trainer_status'=>'Reason',
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
		$criteria->compare('state',$this->state,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('zoom',$this->zoom);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_login',$this->last_login,true);		
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('fax_no',$this->fax_no,true);				
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('city',$this->city,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}