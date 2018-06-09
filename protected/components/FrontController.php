<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $user_login;
    public $user_feedback;
    public $user_signUp;

    public function init() {
        $this->user_feedback = new SiteFeedback('site');

        $this->user_login = new LoginForm();
        $parameters = Settings::model()->findByPk(1);
        $this->user_signUp = new User();

        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['pinterest'] = $parameters['pinterest'];
        Yii::app()->params['support_email'] = $parameters['support_email'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['paypal_email'] = $parameters['paypal_email'];
        Yii::app()->params['address'] = $parameters['address'];
        Yii::app()->params['youtube'] = $parameters['youtube'];
        Yii::app()->params['lat'] = $parameters['lat'];
        Yii::app()->params['long'] = $parameters['long'];
        Yii::app()->params['country'] = $parameters['country'];
        Yii::app()->params['dc_code'] = $parameters['default_currency_code'];
        Yii::app()->params['dc_symbol'] = $parameters['default_currency_symbol'];

        Yii::app()->params['meta_author'] = $parameters['meta_author'];
        Yii::app()->params['meta_keywords'] = $parameters['meta_keywords'];
        Yii::app()->params['meta_desc'] = $parameters['meta_desc'];
        Yii::app()->params['contact_info'] = $parameters['contact_info'];
        Yii::app()->params['faq_intro'] = $parameters['faq_intro'];
    }

}