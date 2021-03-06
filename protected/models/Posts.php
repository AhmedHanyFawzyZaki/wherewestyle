<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property integer $views
 * @property integer $comments
 * @property string $image
 * @property integer $status
 */
class Posts extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Posts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('views, comments, status', 'numerical', 'integerOnly' => true),
            array('title, image', 'length', 'max' => 300),
            array('date', 'length', 'max' => 30),
            array('content', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, content, date, views, comments, image, status', 'safe', 'on' => 'search'),
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
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
            'views' => 'Views',
            'comments' => 'Comments',
            'image' => 'Image',
            'status' => 'Status',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('views', $this->views);
        $criteria->compare('comments', $this->comments);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('status', $this->status);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}