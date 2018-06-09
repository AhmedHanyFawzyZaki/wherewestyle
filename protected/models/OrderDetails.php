<?php

/**
 * This is the model class for table "order_details".
 *
 * The followings are the available columns in table 'order_details':
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $create_time
 * @property integer $qty
 * @property string $cost
 * @property integer $comment
 * @property integer $temp2
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Product $product
 */
class OrderDetails extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OrderDetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order_details}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_id, user_id, product_id, qty, comment, temp2', 'numerical', 'integerOnly' => true),
            array('create_time', 'length', 'max' => 255),
            array('cost', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, order_id, user_id, product_id, create_time, qty, cost, comment, temp2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_id' => 'Order',
            'user_id' => 'User',
            'product_id' => 'Product',
            'create_time' => 'Create Time',
            'qty' => 'Qty',
            'cost' => 'Cost',
            'comment' => 'Comment',
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
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('qty', $this->qty);
        $criteria->compare('cost', $this->cost, true);
        $criteria->compare('comment', $this->comment);
        $criteria->compare('temp2', $this->temp2);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}