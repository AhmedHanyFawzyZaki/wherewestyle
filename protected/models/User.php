<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $image
 * @property string $details
 * @property integer $group
 * @property integer $active
 * @property integer $user_credit
 *
 * The followings are the available model relations:
 * @property UserDetails $userDetails
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $verifyCode;
    public $newpassword;
    public $newpassword_repeat;
    public $address;
    public $lv = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'unique', 'message' => 'This email has already been taken.'),
            array('username', 'unique'),
            array('email', 'email'),
            array('username,email', 'required'),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'Username can contain only alphanumeric characters and hyphens(-).'),
            array('username', 'length', 'max' => 50),
            array('email, fname, lname, image, allowed_notifs, allowed_email_notifs,activation_code,ggl_oauth_token,ggl_oauth_secret', 'length', 'max' => 255),
            array('password', 'length', 'max' => 250),
            array('details,groups_id,course_allowed,user_credit,active', 'safe'),
            array('password,username,fname,lname', 'required', 'on' => 'create ,update'),
            array('details', 'safe', 'on' => 'create'),
            array('facebook,twitter,googleplus,youtube,image,currency,facebook_id,twitter_id,twitter_token,twitter_token_secret, fb_sharing', 'safe'),
            // The following rule is used by search().
            array(' username, email, password, fname, lname, image, details, groups_id', 'safe', 'on' => 'search'),
            //array('password, password_repeat', 'safe','on'=>'register'),
            array('email,password,password_repeat', 'required', 'on' => 'register'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => 'register'),
            // array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'register'),		    
            array('newpassword', 'compare', 'compareAttribute' => 'newpassword_repeat', 'on' => 'editpassword'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => 'create ,update'),
            array('email,password,username,password_repeat', 'required', 'on' => 'create ,update'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usergroup' => array(self::BELONGS_TO, 'Groups', 'groups_id'),
            'curr' => array(self::BELONGS_TO, 'Currency', 'currency'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'fname' => 'First name',
            'lname' => 'Last name',
            'image' => 'Image',
            'details' => 'Details',
            'groups_id' => 'Account Type',
            'active' => 'Active',
            'password_repeat' => 'Repeat password',
            'verifyCode' => 'Verification Code',
            'user_credit' => 'User Credit',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('groups_id', $this->groups_id, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('user_credit', $this->user_credit);
        
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->lv) {
                $this->password = $this->hash($this->password);
            }
            return true;
        }
        return false;
    }

    // Authentication methods
    public function hash($value) {
        return $this->simple_encrypt($value);
    }

    public static function simple_encrypt($text, $salt = "supertestpass123") {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function simple_decrypt($text, $salt = "supertestpass123") {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function check($value) {
        $new_hash = $this->simple_encrypt($value);
        if ($new_hash == $this->password) {
            return true;
        }
        return false;
    }

    public static function getProfileType() {
        if (Yii::app()->user->group == 1) {
            return 'member';
        } else if (Yii::app()->user->group == 2) {
            return '2';
        } else if (Yii::app()->user->group == 3) {
            return '3';
        } else if (Yii::app()->user->group == 4) {
            return '4';
        } else if (Yii::app()->user->group == 6) {
            return 'dashboard';
        } else {
            return '#';
        }
    }

    public static function CheckAdmin() {
        if (( Yii::app()->user->isGuest)) {
            return false;
        } else if (Yii::app()->user->group == 6) {
            return true;
        } else {
            return false;
        }
    }

    public static function CheckPermission($type) {
        if (( Yii::app()->user->isGuest)) {
            return false;
        }

        switch ($type) {
            case 'member':
                if (Yii::app()->user->group == 1)
                    return true;
                break;
            case 'stuff':
                if (Yii::app()->user->group == 4)
                    return true;
                break;
            default:
                return false;
        } // switch
    }

    public function getSellers() {
        $criteria = new CDbCriteria();
        $criteria->condition = 'groups_id="2"';
        return CHtml::listData(User::model()->findAll($criteria, array('order' => 'id DESC')), 'id', 'username');
    }

    public function getUsers() {
        return CHtml::listData(User::model()->findAll(), 'id', 'username');
    }

}
