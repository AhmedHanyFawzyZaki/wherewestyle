<?php

/**
 * This is the model class for table "follow_product".
 *
 * The followings are the available columns in table 'follow_product':
 * @property integer $id
 * @property integer $pro_id
 * @property string $followers
 *
 * The followings are the available model relations:
 * @property Products $pro
 */
class FollowProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FollowProduct the static model class
	 */
	 
	public $selection;
	public $userList;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{follow_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pro_id', 'numerical', 'integerOnly'=>true),
			array('followers', 'length', 'max'=>255),
			array('selection, userList', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pro_id, followers', 'safe', 'on'=>'search'),
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
			'pro' => array(self::BELONGS_TO, 'Product', 'pro_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pro_id' => 'Product',
			'followers' => 'Followers',
			'userList' => 'Followers',
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
		$criteria->compare('pro_id',$this->pro_id);
		$criteria->compare('followers',$this->followers,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		if(!empty($this->selection))
		{
			$this->followers=implode(',',$this->selection);
			return true;
		}
	}

	public function afterFind() {
		
		$this->selection=explode(',',$this->followers);
		
		////// to retrieve it as title1,title2
		foreach($this->selection as $item)
		{
			$List_arr[]=User::model()->findByPk($item)->username;
		}
		
		$this->userList=implode(', ',$List_arr);
		
		return true;
	}
}