<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property string $id
 * @property string $subject
 * @property string $content
 * @property integer $sender_id
 * @property integer $reciever_id
 * @property string $parent_id
 * @property integer $status
 * @property string $date
 * @property string $last_update
 *
 * The followings are the available model relations:
 * @property Messages $parent
 * @property Messages[] $messages
 * @property User $reciever
 * @property User $sender
 */
class Messages extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{messages}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sender_id, reciever_id, status', 'numerical', 'integerOnly' => true),
            array('subject', 'length', 'max' => 300),
            array('parent_id, date, last_update', 'length', 'max' => 30),
            array('content', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, subject, content, sender_id, reciever_id, parent_id, status, date, last_update', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'Messages', 'parent_id'),
            'messages' => array(self::HAS_MANY, 'Messages', 'parent_id'),
            'reciever' => array(self::BELONGS_TO, 'User', 'reciever_id'),
            'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'subject' => 'Subject',
            'content' => 'Content',
            'sender_id' => 'Sender',
            'reciever_id' => 'Reciever',
            'parent_id' => 'Parent',
            'status' => 'Status',
            'date' => 'Date',
            'last_update' => 'Last Update',
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
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('sender_id', $this->sender_id);
        $criteria->compare('reciever_id', $this->reciever_id);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('last_update', $this->last_update, true);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}