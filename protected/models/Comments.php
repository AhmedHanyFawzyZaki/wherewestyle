<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property string $id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property string $date
 * @property integer $post_id
 */
class Comments extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{comments}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, post_id, status', 'numerical', 'integerOnly' => true),
            array('name, email', 'length', 'max' => 300),
            array('date', 'length', 'max' => 30),
            array('content', 'safe'),
            array('name, email, content', 'required', 'on' => 'unreg'),
            array('email', 'email', 'on' => 'unreg'),
            array('content', 'required', 'on' => 'reg'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, name, email, content, date, post_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'post' => array(self::BELONGS_TO, 'Posts', 'post_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'name' => 'Name',
            'email' => 'Email',
            'content' => 'Comment',
            'date' => 'Date',
            'post_id' => 'Post',
            'status' => 'Status'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('post_id', $this->post_id);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
