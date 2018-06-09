<?php

/**
 * This is the model class for table "bank_transfers".
 *
 * The followings are the available columns in table 'bank_transfers':
 * @property string $id
 * @property string $internet_banking_nickname
 * @property string $transaction_date
 * @property integer $transaction_hour
 * @property integer $transaction_minute
 * @property string $transaction_reference_no
 * @property string $amount_transfered
 * @property string $receipt
 * @property string $other_info
 * @property integer $order_id
 * @property string $date
 */
class BankTransfers extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return BankTransfers the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{bank_transfers}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('transaction_hour, transaction_minute, order_id, status, bank_account_id', 'numerical', 'integerOnly' => true),
            array('internet_banking_nickname, transaction_reference_no, bank_name', 'length', 'max' => 300),
            array('transaction_date, amount_transfered, date', 'length', 'max' => 100),
            array('receipt', 'length', 'max' => 200),
            array('other_info', 'safe'),
            array('internet_banking_nickname, transaction_reference_no, bank_name, transaction_date, amount_transfered, transaction_hour, transaction_minute, bank_account_id', 'required', 'on' => 'bnkt'),
            array('receipt', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, internet_banking_nickname, transaction_date, transaction_hour, transaction_minute, transaction_reference_no, amount_transfered, receipt, other_info, order_id, date', 'safe', 'on' => 'search'),
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
            'bank' => array(self::BELONGS_TO, 'Banks', 'bank_account_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'internet_banking_nickname' => 'Internet Banking Nickname',
            'transaction_date' => 'Transaction Date',
            'transaction_hour' => 'Transaction Hour',
            'transaction_minute' => 'Transaction Minute',
            'transaction_reference_no' => 'Transaction Reference No',
            'amount_transfered' => 'Amount Transfered',
            'receipt' => 'Receipt',
            'other_info' => 'Other Info',
            'order_id' => 'Order',
            'date' => 'Date',
            'bank_account_id' => 'Bank Account'
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
        $criteria->compare('internet_banking_nickname', $this->internet_banking_nickname, true);
        $criteria->compare('transaction_date', $this->transaction_date, true);
        $criteria->compare('transaction_hour', $this->transaction_hour);
        $criteria->compare('transaction_minute', $this->transaction_minute);
        $criteria->compare('transaction_reference_no', $this->transaction_reference_no, true);
        $criteria->compare('amount_transfered', $this->amount_transfered, true);
        $criteria->compare('receipt', $this->receipt, true);
        $criteria->compare('other_info', $this->other_info, true);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('date', $this->date, true);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}