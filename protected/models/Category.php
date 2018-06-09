<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property integer $sort
 * @property string $image
 * @property integer $parent_id
 * @property integer $temp1
 * @property integer $temp2
 * @property string $slug
 */
class Category extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sort, parent_id, temp1, temp2', 'numerical', 'integerOnly' => true),
            array('title, image, slug', 'length', 'max' => 255),
            array('desc', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, desc, sort, image, parent_id, temp1, temp2', 'safe', 'on' => 'search'),
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
            'desc' => 'Desc',
            'sort' => 'Sort',
            'image' => 'Image',
            'parent_id' => 'Parent',
            'temp1' => 'Temp1',
            'temp2' => 'Temp2',
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
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('parent_id', $this->parent_id);

        $criteria->addInCondition('parent_id', array(0,));

        $criteria->order = "id DESC";


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    protected function beforeSave() {
        if (parent::beforeSave()) {
            if($this->title)
            {
                $this->slug=Helper::slugify($this->title);
            }
            return true;
        }
        return false;
    }

    public function getCatlist() {
        $criteria = new CDbCriteria;

        $criteria->condition = 'parent_id = 0';
        //$criteria->order ='`sort`';

        return CHtml::listData(Category::model()->findAll($criteria), 'id', 'title');
    }
    
    public function find_by_slug($slug){
        $criteria = new CDbCriteria;
        $criteria->condition = 'slug = :slug';
        $criteria->params = array(':slug' => $slug);
        return Category::model()->find($criteria);
    }

}