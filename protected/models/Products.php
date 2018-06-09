<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $meta
 * @property double $price
 * @property double $stock
 * @property double $sold
 * @property string $start_date
 * @property integer $cat_id
 * @property integer $shop_id
 * @property integer $auto_delete
 * @property integer $active
 */
class Products extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Products the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{products}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cat_id, shop_id, auto_delete, active,gallery_id', 'numerical', 'integerOnly' => true),
            array('price, stock, sold', 'numerical'),
            array('title, meta, start_date,slug', 'length', 'max' => 255),
            array('desc', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, desc, meta, price, stock, sold, start_date, cat_id, shop_id, auto_delete, active', 'safe', 'on' => 'search'),
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
            'desc' => 'Description',
            'meta' => 'Meta tags',
            'price' => 'Price',
            'stock' => 'Stock Amount',
            'sold' => 'Sold Amount',
            'start_date' => 'Posted On',
            'cat_id' => 'Category',
            'shop_id' => 'Shop',
            'gallery_id' => 'Gallery',
            'auto_delete' => 'Auto Delete',
            'active' => 'Active',
            'slug' => 'slug',
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
        $criteria->compare('meta', $this->meta, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('stock', $this->stock);
        $criteria->compare('sold', $this->sold);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('shop_id', $this->shop_id);
        $criteria->compare('auto_delete', $this->auto_delete);
        $criteria->compare('active', $this->active);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /* function behaviors() {
      if($this->hasAttribute('start_date')){
      return array(
      'CTimestampBehavior' => array(
      'class' => 'zii.behaviors.CTimestampBehavior',
      'createAttribute' => 'start_date',
      ),
      );
      }
      return array();
      } */

    public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function getProducts() {
        return CHtml::listData(Products::model()->findAll(), 'id', 'title');
    }

}