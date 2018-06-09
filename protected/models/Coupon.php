<?php

/**
 * This is the model class for table "coupon".
 *
 * The followings are the available columns in table 'coupon':
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $redem_num
 * @property double $discount
 * @property integer $type
 * @property integer $shop_id
 *
 * The followings are the available model relations:
 * @property Shop $shop
 */
class Coupon extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Coupon the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{coupon}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('redem_num, type, shop_id, used_num', 'numerical', 'integerOnly' => true),
            array('discount', 'numerical'),
            array('title, code', 'length', 'max' => 255),
            array('code, redem_num, discount', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, code, redem_num, discount, type, shop_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'shopName' => array(self::BELONGS_TO, 'Shop', 'shop_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'code' => 'Code',
            'redem_num' => 'Redemption Num.',
            'discount' => 'Discount',
            'type' => 'Type',
            'shop_id' => 'Shop',
            'used_num' => 'Usage Num.',
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
        $criteria->compare('code', $this->code, true);
        $criteria->compare('redem_num', $this->redem_num);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('type', $this->type);
        $criteria->compare('shop_id', $this->shop_id);
        $criteria->compare('used_num', $this->used_num);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}