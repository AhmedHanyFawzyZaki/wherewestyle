<?php

/**
 * This is the model class for table "banks".
 *
 * The followings are the available columns in table 'banks':
 * @property integer $id
 * @property string $name
 * @property string $account_name
 * @property string $account_number
 * @property string $icon
 * @property integer $status
 */
class Banks extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Banks the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{banks}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'numerical', 'integerOnly' => true),
            array('name, account_name, account_number, icon, bank_code, branch_code, account_type', 'length', 'max' => 300),
            array('icon', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, account_name, account_number, icon, status', 'safe', 'on' => 'search'),
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
            'name' => 'Bank Name',
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'icon' => 'Icon',
            'account_type' => 'Account Type',
            'bank_code' => 'Bank Code',
            'branch_code' => 'Branch Code',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('account_name', $this->account_name, true);
        $criteria->compare('account_number', $this->account_number, true);
        $criteria->compare('icon', $this->icon, true);
        $criteria->compare('bank_code', $this->bank_code, true);
        $criteria->compare('branch_code', $this->branch_code, true);
        $criteria->compare('account_type', $this->account_type, true);
        $criteria->compare('status', $this->status);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}