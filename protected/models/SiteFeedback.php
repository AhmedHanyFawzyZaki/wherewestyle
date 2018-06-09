<?php

/**
 * This is the model class for table "site_feedback".
 *
 * The followings are the available columns in table 'site_feedback':
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $content
 * @property string $feed_time
 */
class SiteFeedback extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SiteFeedback the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{site_feedback}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('full_name, email, content, feed_time', 'length', 'max' => 255),
            array('full_name,email,content', 'required', 'on' => 'site'),
            array('email', 'email', 'on' => 'site'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, full_name, email, content, feed_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'content' => 'Content',
            'feed_time' => 'Feed Time',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('feed_time', $this->feed_time, true);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}