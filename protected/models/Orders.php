<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $total
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $address
 * @property integer $status_id
 * @property string $order_date
 * @property string $token
 * @property integer $country_id
 * @property string $phone
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property OrderDetails[] $orderDetails
 * @property User $user
 */
class Orders extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{orders}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status_id, country_id, user_id, payment_method', 'numerical', 'integerOnly' => true),
            array('total, username, first_name, last_name, email, address, order_date, token, phone', 'length', 'max' => 255),
            array('currency_rate', 'numerical'),
            array('first_name, last_name, email, address, phone, country_id', 'required', 'on' => 'chk'),
            array('email', 'email', 'on' => 'chk'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, total, username, first_name, last_name, email, address, status_id, order_date, token, country_id, phone, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'orderDetails' => array(self::HAS_MANY, 'OrderDetails', 'order_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'status' => array(self::BELONGS_TO, 'OrderStatus', 'status_id'),
            'country' => array(self::BELONGS_TO, 'AllCountries', 'country_id'),
            'payment' => array(self::BELONGS_TO, 'PaymentMethods', 'payment_method'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'total' => 'Total',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'address' => 'Address',
            'status_id' => 'Status',
            'order_date' => 'Order Date',
            'token' => 'Token',
            'country_id' => 'Country',
            'phone' => 'Phone',
            'user_id' => 'Username',
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
        $criteria->compare('total', $this->total, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('user_id', $this->user_id);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function get_pm() {
        $ret = "Not available";

        $info = BankTransfers::model()->findByAttributes(array('order_id' => $this->id));
        if ($info) {
            $ret = "<a href='" . Yii::app()->createUrl("bankTransfers/view", array('id' => $info->id)) . "'>Info</a>";
        }

        return $ret;
    }

}
