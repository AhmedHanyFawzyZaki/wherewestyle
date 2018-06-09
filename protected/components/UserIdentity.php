<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

        $criteria = new CDbCriteria();
        $criteria->condition = 'username ="' . $this->username . '"  or lower(email)= "' . strtolower($this->username) . '" ';

        $user = User::model()->find($criteria);

        if ($user === null) {
            $this->errorCode = 3;
        } else if (!$user->active) {
            $this->errorCode = 7;
        } else if ($user->check($this->password)) {

            if ($user->groups_id != 6) {
                $o_shop = Shop::model()->findByAttributes(array('seller_id' => $user->id));
                if ($o_shop) {
                    $user->password = $user->simple_decrypt($user->password);
                    $user->groups_id = 2;
                    $user->save(false);
                }else{
                    $user->password = $user->simple_decrypt($user->password);
                    $user->groups_id = 1;
                    $user->save(false);
                }
            }

            $this->_id = $user->id;
            $this->setState('username', $user->username);
            $this->setState('fname', $user->fname);
			$this->setState('fb_sharing', $user->fb_sharing);
            $this->setState('lname', $user->lname);
            $this->setState('email', $user->email);
            $this->setState('group', $user->groups_id);
            $curr = Currency::model()->findByPk($user->currency);
            if ($curr) {
                $this->setState('currency_code', $curr->iso_code);
                $this->setState('currency_rate', $curr->rate);
                $this->setState('currency_symbol', $curr->symbol);
                $this->setState('currency_icon', $curr->icon);
            } else {
                $this->setState('currency_code', Yii::app()->params['dc_code']);
                $this->setState('currency_symbol', Yii::app()->params['dc_symbol']);
                $this->setState('currency_rate', '1');
                $this->setState('currency_icon', 'sing_flag.gif');
            }
            $this->errorCode = 'done';
        } else {
            $this->errorCode = 3;
        }


        return $this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
