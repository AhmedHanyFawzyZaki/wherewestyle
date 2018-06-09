<?php

class HomeController extends FrontController {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewActionM',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->layout = 'index_layout';
        Yii::app()->clientScript->registerMetaTag('where we style is your choice to start your business in selling and buying products', 'description');
        Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl.'/img/logo.png', 'image');
        $criteria = new CDbCriteria;
        $criteria->condition = 'small_featured=1 AND active=1';
        $criteria->limit = 14;
        $smallShops = Shop::model()->findAll($criteria);

        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'big_featured=1 AND active=1';
        $criteria1->order = 'rand()';
        $criteria1->limit = 3;
        $bigShops = Shop::model()->findAll($criteria1);

        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'featured=1 AND active=1';
        $criteria2->limit = 16;
        $products = Product::model()->findAll($criteria2);

        $banners = Banner::model()->findAll('publish="1"');

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->limit = 4;
        $posts = Posts::model()->findAll($criteria);
        $model_user = User::model()->findByPk(Yii::app()->user->id);
        $user = Yii::app()->facebook->getUser();

        if ($user) {
			//echo $user;die;
            if ($_GET['code']) {
				//var_dump($user);die;
                $model_user->facebook_id = $user;
		$us_info=Yii::app()->facebook->getInfoById($user);
		$model_user->facebook=$us_info['name'];
                $model_user->password = $model_user->simple_decrypt($model_user->password);
                $model_user->save(false);
            }
        }

        $this->render('index', array('banners' => $banners,
            'bigShops' => $bigShops,
            'products' => $products,
            'posts' => $posts,
            'smallShops' => $smallShops));
    }

    public function actionTest2() {
        $this->render('test');
    }

    public function actionFaq() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Faq::model()->findAll();
        $this->render('faq', array('faqs' => $model,));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionBlog() {

        $criteria = new CDbCriteria;
        $criteria->condition = 'status = 1';
        $criteria->order = 'id DESC';

        $count = Posts::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 8;
        $pages->applyLimit($criteria);

        $posts = Posts::model()->findAll($criteria);

        $this->render('blog', array('posts' => $posts, 'pages' => $pages));
    }

    public function actionPost($id) {

        $flag = false;
        $post = Posts::model()->findByPk($id);
        if ($post === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (Yii::app()->user->isGuest) {
            $model = new Comments('unreg');
        } else {
            $model = new Comments('reg');
        }

        if (isset($_POST['Comments'])) {
            $model->attributes = $_POST['Comments'];
            $model->date = time();
            $model->post_id = $post->id;
            if (!Yii::app()->user->isGuest) {
                $model->user_id = Yii::app()->user->id;
            }
            if ($model->save()) {
                Yii::app()->user->setFlash('comment', 'Thank you for your comment. Your comment is currently being reviewed for approval.');
                $this->redirect(array('Post', 'id' => $post->id));
            }
            $flag = true;
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'post_id = ' . $post->id;
        $criteria->addCondition("status = 1");
        $criteria->order = 'id DESC';
        $comments = Comments::model()->findAll($criteria);

        $this->render('post', array('post' => $post, 'comments' => $comments, 'model' => $model, 'flag' => $flag));
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        //echo Helper::yiiparam('adminEmail');
        $this->layout = 'pagination_layout';

        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->first_name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Helper::yiiparam('adminEmail'), $subject, $model->message, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionTest($slug) {
        echo $slug;
    }

    public function actionNotifications() {
        if (!Yii::app()->user->isGuest) {
            $this->layout = 'pagination_layout';

            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=' . Yii::app()->user->id;
            $criteria->order = 'id DESC';


            $count = Notifications::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 15;
            $pages->applyLimit($criteria);

            $notifs = Notifications::model()->findAll($criteria);

            $this->render('notifications', array('notifs' => $notifs, 'pages' => $pages));
        } else {
            throw new CHttpException(404, "this page doesn't exist");
        }
    }

    public function actionNotification_view() {
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=' . Yii::app()->user->id;
            $criteria->order = 'id DESC';
            $criteria->limit = 5;
            $notifs = Notifications::model()->findAll($criteria);

            if ($notifs) {
                foreach ($notifs as $nt) {
                    if (!$nt->status) {
                        $nt->status = 1;
                        $nt->save();
                    }
                }
            }

            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=' . Yii::app()->user->id;
            $criteria->addCondition('status = 0');
            $n_c = Notifications::model()->count($criteria);

            echo $n_c;
        } else {
            echo '0';
        }
    }

    public function actionRegister() {
		
        $user_signUp = $this->user_signUp;
        $user_signUp->scenario = 'register';

        if (isset($_POST['User'])) {



            $user_signUp->attributes = $_POST['User'];
            $user_signUp->activation_code = md5(rand(0, 999999999999999) . time());
            if ($_POST['User']['groups_id'] == '') {
                $user_signUp->groups_id = '1';
            }

            //make the default of register user to receive email in specific notification
            
			//$user_signUp->allowed_email_notifs = '4,5,6';

            if ($user_signUp->save()) {

                $user_details = new UserDetails();
                $user_details->user_id = $user_signUp->id;
                $user_details->save(false);

                $subsc = new Newsletter;//subscribed
                $subsc->name = $user_signUp->username;
                $subsc->email = $user_signUp->email;
                $subsc->save();



                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], ' Where We Style MailBoy');
                $mail->setTo($user_signUp->email);
                $mail->setSubject('Wherewestyle confirmation email');

                $message = '
                <br/>
                User account information  <br/>
                ________________________________________<br/>
                Username:  ' . $user_signUp->username . '<br/>
                Password:   ' . $user_signUp->simple_decrypt($user_signUp->password) . '<br/>
                Activation link : http://' . Yii::app()->request->getServerName() . Yii::app()->createUrl('home/activate', array('actcode' => $user_signUp->activation_code)) . '
                ';

                $mail->setBody($message);

                if ($mail->send()) {
                    Yii::app()->user->setFlash('register-success', 'Thank you! An activation email has been sent to your email address.');
                } else {
                    Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                }

                $this->redirect(array('home/index'));
            } else {
                foreach ($user_signUp->getErrors() as $error) {
                    $list.=$error[0] . '<br>';
                }
                echo 'wrong' . '*-*' . $list . '<br>';
                die;
            }
        }

        $this->render('register', array(
            'model' => $model,
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'column2';

        $user_login = $this->user_login;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($user_login);
            Yii::app()->end();
        }


        if (isset($_POST['LoginForm'])) {
            $user_login->attributes = $_POST['LoginForm'];

            if ($user_login->validate() && $user_login->login() === "done") {
                echo "done";
            } else {
                if ($user_login->login() === 3) {
                    echo "Invalid username or password";
                } else if ($user_login->login() === 7) {
                    echo "Your account has been deactivated.";
                }
            }
        }
    }

    public function actionActivate() {
		$act_code=$_GET['actcode'];
		$code=$_GET['code'];
        
		if($code && $act_code)
		{
			$user=User::model()->findByPk(Yii::app()->user->id);
			$user->facebook_id = Yii::app()->facebook->getUser();
			$us_info=Yii::app()->facebook->getInfoById($user->facebook_id);
			$user->facebook=$us_info['name'];
			$user->password = $user->simple_decrypt($user->password);
			if($user->save(false)){
				$fb_frs=Yii::app()->facebook->api('/me/friends');
				if($fb_frs['data']){
					foreach($fb_frs['data'] as $fr)
					{
						$fr_arr[]=$fr['id'];
					}
					$wws_fb_fr=User::model()->findAll(array('condition'=>'facebook_id in ('.implode(',',$fr_arr).')'));
					if($wws_fb_fr)
					{
						foreach($wws_fb_fr as $fr_fb)
						{
							Helper::create_notif($fr_fb->id,'1',$user->id);
						}
					}
				}
			}
                        
			$this->redirect(array('/home'));
		}
		elseif ($act_code) {
            $user = User::model()->findByAttributes(array('activation_code' => $act_code, 'active' => '0'));
            if ($user) {
                $user->active = 1;
                $user->activation_code = "";
                $user->password = $user->simple_decrypt($user->password);
                $user->save(false);
				
                Yii::app()->user->id = $user->id;
                Yii::app()->user->setState('username', $user->username);
                Yii::app()->user->setState('fname', $user->fname);
                Yii::app()->user->setState('lname', $user->lname);
                Yii::app()->user->setState('email', $user->email);
                Yii::app()->user->setState('group', $user->groups_id);
                $curr = Currency::model()->findByPk($user->currency);
                if ($curr) {
                    Yii::app()->user->setState('currency_code', $curr->iso_code);
                    Yii::app()->user->setState('currency_rate', $curr->rate);
                    Yii::app()->user->setState('currency_symbol', $curr->symbol);
                } else {
                    Yii::app()->user->setState('currency_code', Yii::app()->params['dc_code']);
                    Yii::app()->user->setState('currency_symbol', Yii::app()->params['dc_symbol']);
                    Yii::app()->user->setState('currency_rate', '1');
                }

                $this->render('activate');
            } else {
                throw new CHttpException(404, "this page doesn't exist");
            }
        } 
		else {
            throw new CHttpException(404, "this page doesn't exist");
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionForgotpass() {

        $model = new User;
        if (isset($_POST['email'])) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'email=:email';
            $criteria->params = array(':email' => $_POST['email']);
            $usermodel = User::model()->find($criteria);



            if ($usermodel) {

                $key = Helper::GenerateRandomKey();
                $usermodel->pass_reset = 1;
                $usermodel->pass_code = $key;
                $usermodel->password = $usermodel->simple_decrypt($usermodel->password);
                $usermodel->save(false);

                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], ' Where We Style MailBoy');
                $mail->setTo($_POST['email']);
                $mail->setSubject('WhereWeStyle Password Reset');

                $message = 'Dear customer,
                <br />
                Please follow this link to reset your password :
                <br />
                URL:   ' . Yii::app()->request->getBaseUrl('webroot') . '/home/reset?hash=' . $usermodel->pass_code . '

                ';

                $mail->setBody($message);


                if ($mail->send()) {
                    echo 'Thank you! An email has been sent to your email address.';
                } else {
                    echo 'Error while sending the email';
                }
            } else {
                echo "2";
            }
        }
    }

    public function actionReset($hash) {

        $criteria = new CDbCriteria;
        $criteria->condition = 'pass_code=:Hash and pass_reset=1';
        $criteria->params = array(':Hash' => $hash);
        $user_found = User::model()->find($criteria);

        if ($user_found) {

            $model = new User('passreset');


            if (isset($_POST['User'])) {

                $model->attributes = $_POST['User'];
                if ($_POST['User']['newpassword'] && ($model->newpassword == $model->newpassword_repeat)) {

                    $user_found->pass_reset = 0;
                    $user_found->pass_code = '';
                    $user_found->password = $_POST['User']['newpassword'];

                    $user_found->save(false);

                    Yii::app()->user->setFlash('status', 'now you can login with your new credentials');

                    $this->redirect(array("reset_done"));
                } else {
                    Yii::app()->user->setFlash('status', 'You must repeat the new password correctly');
                }
            }
            $this->render('resetpass', array('model' => $model));
        } else {
            throw new CHttpException(404, 'error');
        }
    }

    public function actionReset_done() {
        if (Yii::app()->user->hasFlash("status")) {
            $this->render('reset_done');
        } else {
            throw new CHttpException(404, 'error');
        }
    }

    public function actionSaveFeedbacks() {
        $user_feedback = $this->user_feedback;

        $this->performAjaxValidation($user_feedback);
        if (isset($_POST['SiteFeedback'])) {
            $user_feedback->attributes = $_POST['SiteFeedback'];
            $user_feedback->feed_time = date("Y-m-d H:i:s");
            if ($user_feedback->save()) {
                echo '<script>
              alert("Your feedback saved successfully");
            </script>';
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionProfile() {
        if (Yii::app()->user->isGuest) {
            $this->redirect('index');
        }

        $id = Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        $user->scenario = 'profedit';

        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:userID';
        $criteria->params = array(':userID' => $user->id);
        $user_details = UserDetails::model()->find($criteria);

        if (isset($_POST['User'], $_POST['UserDetails'])) {
            $user->attributes = $_POST['User'];
            $user->password = $user->simple_decrypt($user->password);

            $user_details->attributes = $_POST['UserDetails'];

            $valid = $user->validate();
            $valid = $user_details->validate() && $valid;

            if ($valid) {
// use false parameter to disable validation
                $user->save(false);
                $user_details->user_id = $user->id;
                $user_details->save(false);
                Yii::app()->user->setFlash('success', 'Your data has been updated successfully.');
            }
        }

        $this->render('profile', array('user' => $user,
            'ChangePassword' => $ChangePassword,
            'user_details' => $user_details));
    }

    public function actionChangePassword() {
        $id = Yii::app()->user->id;
        $user = User::model()->findByPk($id);
        $user->scenario = 'editpassword';

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->pass_reset = 0;
            $user->pass_code = '';
            $user->password = $user->newpassword = $_POST['User']['newpassword'];
            if ($user->save()) {
                Yii::app()->user->setFlash('success', 'Your data has been updated successfully.');
            }
        }
        $this->redirect('profile');
    }

    public function actionSale() {
        $this->layout = 'pagination_layout';

        $pages = '';
        $criteria = new CDbCriteria;
        $criteria->condition = 'sale=1 AND active=1';
        $criteria->order = "id DESC";

        if ($_GET['flag'] != "express") {
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 8;
            $pages->applyLimit($criteria);
        }

        $products = Product::model()->findAll($criteria);

        $view = '_products_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_products_list';
        } else if ($_GET['flag'] == 'express') {
            $view = 'express';
        }

        $this->render('sale', array('products' => $products, 'view' => $view, 'pages' => $pages));
    }

    public function actionListing() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'sale=1 AND active=1';
        $products = Product::model()->findAll($criteria);

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_products_grid', array('products' => $products, 'sale' => false, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_products_list', array('products' => $products, 'sale' => false, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'express') {
            $list = $this->renderPartial('express', array('products' => $products, 'sale' => false, 'show_shop' => true));
            echo $list;
        }
    }

    public function actionShop_products_listing() {
        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'shop_id=:shop AND active=1';
        $criteria2->params = array(':shop' => $_REQUEST['id']);
        $products = Product::model()->findAll($criteria2);

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_products_grid', array('products' => $products, 'sale' => true, 'show_shop' => false));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_products_list', array('products' => $products, 'sale' => true, 'show_shop' => false));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'express') {
            $list = $this->renderPartial('express', array('products' => $products, 'sale' => true, 'show_shop' => false));
            echo $list;
        }
    }

    public function actionShopDetails() {
        $this->layout = 'pagination_layout';
        $slug = $_REQUEST['slug'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'slug=:slug';
        $criteria->params = array(':slug' => $slug);
        $model = Shop::model()->find($criteria);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'shop_id=:shop AND active=1';
        $criteria2->params = array(':shop' => $model->id);
        $criteria2->order = "id DESC";

        if ($_GET['flag'] != "express") {
            $count = Product::model()->count($criteria2);
            $pages = new CPagination($count);
            $pages->pageSize = 8;
            $pages->applyLimit($criteria2);
        }

        $products = Product::model()->findAll($criteria2);

        $view = '_products_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_products_list';
        } else if ($_GET['flag'] == 'express') {
            $view = 'express';
        }

        $next_v = Shop::model()->findBySql('select * from shop where id>' . $model->id . ' order by id asc');
        $prev_v = Shop::model()->findBySql('select * from shop where id<' . $model->id . ' order by id desc');

        $next = "javascript:void(0)";
        if ($next_v)
            $next = Yii::app()->request->baseUrl . '/home/shopDetails/' . $next_v->slug;

        $prev = "javascript:void(0)";
        if ($prev_v)
            $prev = Yii::app()->request->baseUrl . '/home/shopDetails/' . $prev_v->slug;

        $this->render('shop', array('model' => $model, 'products' => $products, 'slug' => $slug, 'next' => $next, 'prev' => $prev, 'pages' => $pages, 'view' => $view));
    }

    public function actionShops() {
        $this->layout = 'pagination_layout';

        $criteria = new CDbCriteria;
        $criteria->condition = 'active=1';
        $criteria->order = 'last_update DESC';

        $count = Shop::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 8;
        $pages->applyLimit($criteria);

        $shops = Shop::model()->findAll($criteria);

        $view = '_shops_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_shops_list';
        }

        $this->render('shops', array('shops' => $shops, 'pages' => $pages, 'view' => $view));
    }

    public function actionSearch_shops() {
        $this->layout = 'pagination_layout';


        $criteria = new CDbCriteria;
        $criteria->condition = 'active=1';
        $criteria->addCondition('(LOWER(title) like"%' . strtolower($_GET['query']) . '%") OR (LOWER(`desc`) like"%' . strtolower($_GET['query']) . '%")');
        if ($_GET['filter'] == "newest") {
            $criteria->order = 'id DESC';
        } else if ($_GET['filter'] == "oldest") {
            $criteria->order = 'id ASC';
        } else if ($_GET['filter'] == "recently_updated") {
            $criteria->order = 'last_update DESC';
        } else if ($_GET['filter'] == "most_followers") {
            $criteria->order = 'followers_count DESC';
        } else if ($_GET['filter'] == "transactions") {
            $criteria->order = 'transaction_count DESC';
        } else if ($_GET['filter'] == "random") {
            $criteria->order = 'rand()';
        } else if ($_GET['filter'] == "following") {
            if (!Yii::app()->user->isGuest) {
                $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');

                if ($shops_ids) {
                    $ids = array();
                    foreach ($shops_ids as $id) {
                        $ids[] = $id->shop_id;
                    }
                    $criteria->addInCondition('id', $ids);
                }
            }
        } else if ($_GET['filter'] == "sws_lh") {
            $criteria->addCondition('store_wide_sale > 0');
            $criteria->order = 'store_wide_sale asc';
        } else if ($_GET['filter'] == "sws_hl") {
            $criteria->addCondition('store_wide_sale > 0');
            $criteria->order = 'store_wide_sale desc';
        } else {
            $criteria->order = "id DESC";
        }

        $count = Shop::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 8;
        $pages->applyLimit($criteria);

        $shops = Shop::model()->findAll($criteria);

        $flag = "grid";
        $view = '_shops_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_shops_list';
            $flag = "list";
        }

        $this->render('shops', array(
            'shops' => $shops,
            'pages' => $pages,
            'view' => $view,
            'search_query' => $_GET['query'],
            'search_filter' => $_GET['filter'],
            "flag" => $flag)
        );
    }

    public function actionSearch_products() {
        $this->layout = 'pagination_layout';

        $pages = '';
        $criteria = new CDbCriteria;
        $criteria->condition = 'active=1';
        $criteria->addCondition('(LOWER(title) like"%' . strtolower($_GET['query']) . '%") OR (LOWER(`desc`) like"%' . strtolower($_GET['query']) . '%")');

        $types = array("sale", "by_cat", "shop", "followed", "favourite");
        $tp = "";
        $ctid = "";
        if ($_GET['type']) {
            if (in_array($_GET['type'], $types)) {
                if ($_GET['type'] == "sale") {
                    $criteria->addCondition('sale = 1');
                    $tp = "sale";
                } else if ($_GET['type'] == "by_cat" && $_GET['spec_id']) {
                    $criteria->addCondition('cat_id = ' . $_GET['spec_id']);
                    $tp = "by_cat";
                    $ctid = $_GET['spec_id'];
                } else if ($_GET['type'] == "by_cat") {
                    $tp = "by_cat";
                } else if ($_GET['type'] == "shop" && $_GET['spec_id']) {
                    $criteria->addCondition('shop_id = ' . $_GET['spec_id']);
                    $tp = "shop";
                    $ctid = $_GET['spec_id'];
                } else if ($_GET['type'] == "followed") {
                    if (!Yii::app()->user->isGuest) {
                        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');

                        if ($shops_ids) {
                            $ids = array();
                            foreach ($shops_ids as $id) {
                                $ids[] = $id->shop_id;
                            }
                            $criteria->addInCondition('shop_id', $ids);
                        }
                        $tp = "followed";
                    }
                } else if ($_GET['type'] == "favourite") {
                    if (!Yii::app()->user->isGuest) {
                        $ids = array();

                        $criteria1 = new CDbCriteria;
                        $criteria1->condition = 'user_id=' . Yii::app()->user->id;
                        $criteria1->order = 'id DESC';
                        $favs = FavouriteProduct::model()->findAll($criteria1);
                        if ($favs) {
                            foreach ($favs as $fa) {
                                $ids[] = $fa->pro_id;
                            }
                            $criteria->addInCondition('id', $ids);
                        }


                        $tp = "favourite";
                    }
                }
            }
        }

        if ($_GET['filter'] == "newest") {
            $criteria->order = 'id DESC';
        } else if ($_GET['filter'] == "following" && $tp != "followed") {
            if (!Yii::app()->user->isGuest) {
                $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
                $ids = array();

                if ($shops_ids) {
                    foreach ($shops_ids as $id) {
                        $ids[] = $id->shop_id;
                    }
                }
                $criteria->addInCondition('shop_id', $ids);
            }
        } else if ($_GET['filter'] == "store_sale" && $_GET['spec_id']) {
            $criteria->order = "sales_count DESC";
            $ctid = $_GET['spec_id'];
        } else if ($_GET['filter'] == "saved") {
            if (!Yii::app()->user->isGuest) {
                if ($_GET['type'] != "favourite") {
                    $fvp = FavouriteProduct::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
                    $fvp_ids = array();
                    if ($fvp) {
                        foreach ($fvp as $f) {
                            $fvp_ids[] = $f->pro_id;
                        }
                    }
                    $criteria->addInCondition('id', $fvp_ids);
                }
            }
        } else if ($_GET['filter'] == "price_high_low") {
            $criteria->order = "price DESC";
        } else if ($_GET['filter'] == "price_low_high") {
            $criteria->order = "price";
        } else if ($_GET['filter'] == "recently_bought") {
            $criteria->select = 't.*';
            $criteria->join = 'INNER JOIN order_details as t2 ON t2.product_id = t.id';
            $criteria->group = "t2.product_id";
            $criteria->order = "t2.id DESC";
        } else {
            $criteria->order = "id DESC";
        }

        $rate = '1';
        if (!Yii::app()->user->isGuest) {
            $rate = Yii::app()->user->getState('currency_rate');
        }

        $search_min_p = "";
        $search_max_p = "";
        if ($_GET['min_price']) {
            $criteria->addCondition('price >= ' . ($_GET['min_price'] / $rate));
            $search_min_p = $_GET['min_price'];
        }
        if ($_GET['max_price']) {
            $criteria->addCondition('price <= ' . ($_GET['max_price'] / $rate));
            $search_max_p = $_GET['max_price'];
        }

        if ($_GET['flag'] != "express") {
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 8;
            $pages->applyLimit($criteria);
        }

        $products = Product::model()->findAll($criteria);

        $view = '_products_grid';
        $flag = "grid";
        if ($_GET['flag'] == 'list') {
            $view = '_products_list';
            $flag = "list";
        } else if ($_GET['flag'] == 'express') {
            $view = 'express';
            $flag = "express";
        }

        $this->render('sale', array('products' => $products,
            'view' => $view,
            'pages' => $pages,
            'search_query' => $_GET['query'],
            'search_filter' => $_GET['filter'],
            "search_type" => $tp,
            "cat_id" => $ctid,
            "search_min_p" => $search_min_p,
            'search_max_p' => $search_max_p,
            "flag" => $flag,
        ));
    }

    public function actionSearch_price() {
        if ($_GET['min'] || isset($_GET['max'])) {
            $this->layout = 'pagination_layout';

            $pages = '';

            $rate = '1';
            if (!Yii::app()->user->isGuest) {
                $rate = Yii::app()->user->getState('currency_rate');
            }

            $criteria = new CDbCriteria;
            $criteria->condition = 'active=1';
            if ($_GET['min']) {
                $criteria->addCondition('price >= ' . ($_GET['min'] / $rate));
            }
            if ($_GET['max']) {
                $criteria->addCondition('price <= ' . ($_GET['max'] / $rate));
            }


            if ($_GET['flag'] != "express") {
                $count = Product::model()->count($criteria);
                $pages = new CPagination($count);
                $pages->pageSize = 8;
                $pages->applyLimit($criteria);
            }

            $products = Product::model()->findAll($criteria);

            $view = '_products_grid';
            if ($_GET['flag'] == 'list') {
                $view = '_products_list';
            } else if ($_GET['flag'] == 'express') {
                $view = 'express';
            }

            $this->render('sale', array('products' => $products, 'view' => $view, 'pages' => $pages, 'min' => $_GET['min'], 'max' => $_GET['max']));
        } else {
            $this->redirect(array('index'));
        }
    }

//    public function actionListingShops() {
//        $criteria = new CDbCriteria;
//
//        $count = Shop::model()->count($criteria);
//        $pages = new CPagination($count);
//
//        // results per page
//        $pages->pageSize = 4;
//        $pages->applyLimit($criteria);
//        $shops = Shop::model()->findAll($criteria);
//
//        if ($_REQUEST['flag'] == 'grid') {
//            $list = $this->renderPartial('_shops_grid', array('shops' => $shops,));
//            echo $list;
//        } elseif ($_REQUEST['flag'] == 'list') {
//            $list = $this->renderPartial('_shops_list', array('shops' => $shops,));
//            echo $list;
//        }
//    }

    public function actionFollowproduct($id) {
//echo $id;die;
        $model = Product::model()->findByPk($id);
        if ($model) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
            $criteria->AddCondition('pro_id=' . $id);
            $flp = FollowProduct::model()->find($criteria);
            if ($flp == '') {
                $fp = FollowProduct::model()->findByAttributes(array('pro_id' => $id));
                $user_ids = array();
                if ($fp) {
                    if ($fp->followers) {
                        $user_ids = explode(',', $fp->followers);
                    }
                } else {
                    $fp = new FollowProduct;
                }
                $user_ids[] = Yii::app()->user->id;
                $fp->selection = $user_ids;
                $fp->pro_id = $id;
                if ($fp->save()) {
                    echo "unfollow";
                }
            } else {
                $user_ids = array();
                $new_users = array();
                $user_ids = explode(',', $flp->followers);
                foreach ($user_ids as $us) {
                    if ($us != Yii::app()->user->id) {
                        $new_users[] = $us;
                    }
                }
                $flp->selection = $new_users;
                if ($flp->save()) {
                    echo "follow";
                }
            }
        } else {
            echo 'error';
        }
    }

    public function actionFollowshop($id, $type = '') {
        if (!Yii::app()->user->isGuest) {
            $model = Shop::model()->findByPk($id);
            if ($model) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
                $criteria->AddCondition('shop_id=' . $id);
                $flp = FollowShop::model()->find($criteria);
                $fstr = "";
                if ($flp == '') {
                    $fp = FollowShop::model()->findByAttributes(array('shop_id' => $id));
                    $user_ids = array();
                    if ($fp) {
                        if ($fp->followers) {
                            $user_ids = explode(',', $fp->followers);
                        }
                    } else {
                        $fp = new FollowShop;
                    }
                    $user_ids[] = Yii::app()->user->id;
                    $fp->selection = $user_ids;
                    $fp->shop_id = $id;
                    if ($fp->save()) {
                        $model->followers_count += 1;
                        $model->save(false);
                        Helper::create_notif($model->seller_id, '6', Yii::app()->user->id);
                        $usr = User::model()->findByPk(Yii::app()->user->id);
						if($usr->fb_sharing==1)
						{
                        	if ($usr->facebook_id) {
                            $params = array(
                                'message' => "I followed this shop at WhereWeStyle.com! <3",
                                'name' => $model->title,
                                'caption' => $model->title,
                                'description' => mb_substr(strip_tags($model->desc), 0, 200),
                                'link' => Yii::app()->request->getBaseUrl('webroot')."/home/shopDetails/" . $model->slug,
                                'picture' => Yii::app()->request->getBaseUrl('webroot')."/media/shops/original/" . $model->image,
                            );
                            try {
                                $post = Yii::app()->facebook->api("/$usr->facebook_id/feed", "POST", $params);
                            } catch (FacebookApiException $e) {
                                
                            }
                        }
						}
                        $fstr = "unfollow";
                    }
                } else {
                    $user_ids = array();
                    $new_users = array();
                    $user_ids = explode(',', $flp->followers);
                    foreach ($user_ids as $us) {
                        if ($us != Yii::app()->user->id) {
                            $new_users[] = $us;
                        }
                    }
                    if (count($new_users) > 0) {
                        $flp->selection = $new_users;
                        if ($flp->save(false)) {
                            $fstr = "follow";
                        }
                    } else {
                        $flp->delete();
                        $fstr = "follow";
                    }
                    $model->followers_count -= 1;
                    $model->save(false);
                }

                $str = "followers";
                if ($model->followers_count == 1) {
                    $str = "follower";
                }
                $str2 = $model->followers_count . " " . $str;
                if ($type == 'shop') {
                    $str2 = "Followers: " . $model->followers_count;
                }

                echo json_encode(array('result' => $fstr, 'count' => $str2));
            } else {
                echo json_encode(array('result' => "error", 'count' => ""));
            }
        } else {
            echo json_encode(array('result' => "error", 'count' => ""));
        }
    }

    public function actionFollowuser($id) {
//echo $id;die;
        $model = User::model()->findByPk($id);
        if ($model) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
            $criteria->AddCondition('user_id=' . $id);
            $flp = FollowUser::model()->find($criteria);
            if ($flp == '') {
                $fp = FollowUser::model()->findByAttributes(array('user_id' => $id));
                $user_ids = array();
                if ($fp) {
                    if ($fp->followers) {
                        $user_ids = explode(',', $fp->followers);
                    }
                } else {
                    $fp = new FollowUser;
                }
                $user_ids[] = Yii::app()->user->id;
                $fp->selection = $user_ids;
                $fp->user_id = $id;
                if ($fp->save()) {
                    echo "unfollow";
                }
            } else {
                $user_ids = array();
                $new_users = array();
                $user_ids = explode(',', $flp->followers);
                foreach ($user_ids as $us) {
                    if ($us != Yii::app()->user->id) {
                        $new_users[] = $us;
                    }
                }
                $flp->selection = $new_users;
                if ($flp->save()) {
                    echo "follow";
                }
            }
        } else {
            echo 'error';
        }
    }

    public function actionFavproduct($id) {
        if (!Yii::app()->user->isGuest) {
            $model = Product::model()->findByPk($id);
            if ($model) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'pro_id=' . $id;
                $criteria->AddCondition('user_id=' . Yii::app()->user->id);
                $flp = FavouriteProduct::model()->find($criteria);
                if ($flp == '') {
                    $fp = new FavouriteProduct;
                    $fp->pro_id = $id;
                    $fp->user_id = Yii::app()->user->id;
                    if ($fp->save()){
                        $usr = User::model()->findByPk(Yii::app()->user->id);
                        if($usr->fb_sharing == 0 && $usr->facebook_id == ''){
                            Yii::app()->user->setState('first_connect', 1);
                            echo "first_connect";
                        }
                        elseif($usr->fb_sharing==1)
                        {
                            if ($usr->facebook_id) 
                            {
                                Yii::app()->user->setState('first_connect', 0);
                                $params = array(
                                    'message' => "I liked this product at WhereWeStyle.com! <3",
                                    'name' => $model->title,
                                    'caption' => $model->title,
                                    'description' => mb_substr(strip_tags($model->desc), 0, 200),
                                    'link' => Yii::app()->request->getBaseUrl('webroot')."productDetails-" . $model->slug,
                                    'picture' => Yii::app()->request->getBaseUrl('webroot')."/media/products/thumbs_266X300/" . $model->main_image,
                                );
                                try {
                                    $post = Yii::app()->facebook->api("/$usr->facebook_id/feed", "POST", $params);
                                } catch (FacebookApiException $e) {

                                }
                            }

                            if ($usr->twitter_token && $usr->twitter_token_secret)
                            {

                                $twitter = Yii::app()->twitter->getTwitterTokened($usr->twitter_token, $usr->twitter_token_secret);
                                $result = $twitter->post('statuses/update', array('status' => "i liked this product ".Yii::app()->request->getBaseUrl('webroot')."/home/productDetails/" . $model->slug));
                                //var_dump($result);die;
                            }

                            echo "fav";
                        }else {
                            echo "fav";
                        }                       
                    }
                } else {
                    if ($flp->delete()) {
                        echo "removed";
                    }
                }
            } else {
                echo 'error';
            }
        }
    }

    public function actionFavshop($id) {
        if (!Yii::app()->user->isGuest) {
            $model = Shop::model()->findByPk($id);
            if ($model) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'shop_id=' . $id;
                $criteria->AddCondition('user_id=' . Yii::app()->user->id);
                $flp = FavouriteShop::model()->find($criteria);
                if ($flp == '') {
                    $fp = new FavouriteShop;
                    $fp->shop_id = $id;
                    $fp->user_id = Yii::app()->user->id;
                    if ($fp->save()) {
                        echo "done";
                    }
                } else {
                    //if($flp->delete()){
                    //echo "follow";  
                    //}
                }
            } else {
                echo 'error';
            }
        }
    }

    public function actionFavuser($id) {
        if (!Yii::app()->user->isGuest) {
            $model = Shop::model()->findByPk($id);
            if ($model) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'member_id=' . $id;
                $criteria->AddCondition('user_id=' . Yii::app()->user->id);
                $flp = FavouriteUser::model()->find($criteria);
                if ($flp == '') {
                    $fp = new FavouriteUser;
                    $fp->member_id = $id;
                    $fp->user_id = Yii::app()->user->id;
                    if ($fp->save()) {
                        echo "done";
                    }
                } else {
                    //if($flp->delete()){
                    //echo "follow";  
                    //}
                }
            } else {
                echo 'error';
            }
        }
    }

    public function actionFollowedProducts() {
		
        $follow_seen=FollowProNotif::model()->findAll(array('condition'=>'follower_id='.Yii::app()->user->id));
        foreach($follow_seen as $FS)
        {
                $FS->seen="1";
                $FS->save(false);
        }
		
        $this->layout = 'pagination_layout';
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $products = '';
        $pages = new CPagination(0);
        $view = '_products_grid';
        if ($shops_ids) {
            $ids = array();
            foreach ($shops_ids as $id) {
                $ids[] = $id->shop_id;
            }

            $criteria = new CDbCriteria();
            $criteria->addInCondition('shop_id', $ids);
            $criteria->order = "id DESC";

            if ($_GET['flag'] != "express") {
                $count = Product::model()->count($criteria);
                $pages = new CPagination($count);
                $pages->pageSize = 8;
                $pages->applyLimit($criteria);
            }


            if ($_GET['flag'] == 'list') {
                $view = '_products_list';
            } else if ($_GET['flag'] == 'express') {
                $view = 'express';
            }
            $products = Product::model()->findAll($criteria);
        }
        $this->render('followedproducts', array('products' => $products, 'view' => $view, 'pages' => $pages));
    }

    public function actionListfp() {

        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $shops = '';
        if ($shops_ids) {
            $ids = array();
            foreach ($shops_ids as $id) {
                $ids[] = $id->shop_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('shop_id', $ids);
            $products = Product::model()->findAll($criteria);
        }

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_products_grid', array('products' => $products, 'sale' => true, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_products_list', array('products' => $products, 'sale' => true, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'express') {
            $list = $this->renderPartial('express', array('products' => $products, 'sale' => true, 'show_shop' => false));
            echo $list;
        }
    }

    public function actionFavouriteProducts() {
        $this->layout = 'pagination_layout';
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }

        $ids = array();

        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . Yii::app()->user->id;
        $criteria->order = 'id DESC';
        $favs = FavouriteProduct::model()->findAll($criteria);
        if ($favs) {
            foreach ($favs as $fa) {
                $ids[] = $fa->pro_id;
            }
        }
        $pages = '';
        $criteria = new CDbCriteria;
        $criteria->condition = 'active = 1';
        $criteria->addInCondition('id', $ids);

        if ($_GET['flag'] != "express") {
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 8;
            $pages->applyLimit($criteria);
        }

        $products = Product::model()->findAll($criteria);

        $view = '_products_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_products_list';
        } else if ($_GET['flag'] == 'express') {
            $view = 'express';
        }

        $this->render('favourite_products', array('products' => $products, 'view' => $view, 'pages' => $pages));
    }

    public function actionListfvp() {

        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $ids = array();

        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . Yii::app()->user->id;
        $criteria->order = 'id DESC';
        $favs = FavouriteProduct::model()->findAll($criteria);
        if ($favs) {
            foreach ($favs as $fa) {
                $ids[] = $fa->pro_id;
            }
        }

        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $ids);
        $products = Product::model()->findAll($criteria);

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_products_grid', array('products' => $products, 'sale' => true, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_products_list', array('products' => $products, 'sale' => true, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'express') {
            $list = $this->renderPartial('express', array('products' => $products, 'sale' => true, 'show_shop' => false));
            echo $list;
        }
    }

    public function actionHelp() {
        $this->render('help');
    }

    public function actionFollowedShops() {
        $this->layout = 'pagination_layout';
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $shops = '';
        $view = '_shops_grid';
        if ($shops_ids) {
            $ids = array();
            foreach ($shops_ids as $id) {
                $ids[] = $id->shop_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);

            $count = Shop::model()->count($criteria);
            $pages = new CPagination($count);

            $pages->pageSize = 8;
            $pages->applyLimit($criteria);

            $shops = Shop::model()->findAll($criteria);


            if ($_GET['flag'] == 'list') {
                $view = '_shops_list';
            }
        }
        $this->render('followedshops', array('shops' => $shops, 'products' => $products, 'pages' => $pages, 'view' => $view));
    }

    public function actionListfs() {

        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $shops = '';
        if ($shops_ids) {
            $ids = array();
            foreach ($shops_ids as $id) {
                $ids[] = $id->shop_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);
            $shops = Shop::model()->findAll($criteria);
        }

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_shops_grid', array('shops' => $shops));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_shops_list', array('shops' => $shops));
            echo $list;
        }
    }

    public function actionFollowedUsers() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $users_ids = FollowUser::model()->findAllBySql('SELECT user_id FROM `follow_user` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $users = '';
        if ($users_ids) {
            $ids = array();
            foreach ($users_ids as $id) {
                $ids[] = $id->user_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);
            $users = User::model()->findAll($criteria);
        }
        $this->render('followedusers', array('users' => $users));
    }

    public function actionListfu() {

        if (Yii::app()->user->isGuest) {
            $this->redirect(array('index'));
        }
        $users_ids = FollowUser::model()->findAllBySql('SELECT user_id FROM `follow_user` WHERE followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '";');
        $users = '';
        if ($users_ids) {
            $ids = array();
            foreach ($users_ids as $id) {
                $ids[] = $id->user_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);
            $users = User::model()->findAll($criteria);
        }

        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_users_grid', array('users' => $users));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_users_list', array('users' => $users));
            echo $list;
        }
    }

    public function actionSearchProducts($search_keyword = '') {
//        $this->layout = 'index_layout';
        $this->layout = 'pagination_layout';
        $criteria = new CDbCriteria;
        $criteria->order = "id DESC";
        $criteria->condition = 'active = 1';

        if ($search_keyword != '') {
            $criteria->addCondition(' LOWER(title)  like :search OR LOWER(`desc`)  like :search ');
            $criteria->params = array(':search' => '%' . strtolower($search_keyword) . '%');
        }

        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 8;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);
// ==================== //


        $this->render('search', array('pages' => $pages,
            'products' => $products,
            'search_keyword' => $search_keyword));
    }

    public function actiongetProducts() {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT id , title as value FROM `product` WHERE title LIKE :qterm ';
            $sql .= ' ORDER BY title ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = '%' . $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
            exit;
        } else {
            return false;
        }
//$campaigns = Campaign::model()->findAll();
    }

// ----------------------------------------------------- shopping cart -------------------------------------------------- //
// =================================================================================================================== //

    public function actionCart($id, $action = '') {
//        if (!Yii::app()->user->isGuest) {
        $product = Product::model()->findByPk($id);

        if ($action == '') {
            $quan = '1';
            if (isset($_REQUEST['quantity'])) {
                $quan = $_REQUEST['quantity'];
            }

            $cart = Yii::app()->shoppingCart->getPositions();
            $flag = true;
            foreach ($cart as $item) {
                if ($item->id == $id) {
                    if (($item->getQuantity() + $quan) > $product->stock) {
                        $flag = false;
                    }
                }
            }

            if ($flag) {
                Yii::app()->shoppingCart->put($product, $quan); //1 item with id=1, quantity=1.
                $action = 1;
            }
            echo json_encode(array('cost' => Helper::shopping_cost(), 'count' => Yii::app()->shoppingCart->getCount()));
        } elseif ($action == 'remove') {
            Yii::app()->shoppingCart->remove($product->getId()); //no items
            $cost = Helper::shopping_cost();
            $_SESSION['shop_discount_' . $product->shop_id] = '0';
            $action = 2;
            $this->redirect(array('shoppingCart', 'action' => $action));
        } elseif ($action == 'clear') {
            Yii::app()->shoppingCart->clear(); //no items
            $this->redirect(array('shoppingCart', 'action' => $action));
        }
//        }
    }

// ================================================================================================================ //
    public function actionupdateCart() {
//        if (!Yii::app()->user->isGuest) {
        $id = $_REQUEST['id'];
        $quant = $_REQUEST['quantity'];
        /* echo '*******************'.$id.'<br/>'.'--------------'.$quant; exit(); */
        $product = Product::model()->findByPk($id);
        $count = $product->stock;
        if ($count > 0 and $count >= $quant) {
            Yii::app()->shoppingCart->update($product, $quant);
            $cost = Helper::shopping_cost();
            $dscn = '0';
            if (isset($_SESSION['discount'])) {
                $dscn = $_SESSION['discount'];
            }
            echo json_encode(array('cost' => $cost, 'discount' => $dscn));
        } else {
            echo json_encode(array('cost' => '0', 'discount' => '0'));
        }
//        }
    }

//=================================================================================================== //
    public function actionShoppingCart($action = '') {
//        if (!Yii::app()->user->isGuest) {
        $model = new Orders('create');
        $cart = Yii::app()->shoppingCart->getPositions();

        $i = 0;
        $shops = array();
        $shops_id = array();
        foreach ($cart as $item) {
            $cartItems[$i] = array($item->id, $item->getQuantity(), $_SESSION['pro_size_' . $item->id], $_SESSION['pro_color_' . $item->id]);
            if (!in_array($item->shop_id, $shops_id)) {
                $shops[] = $item->shopName;
                $shops_id[] = $item->shop_id;
            }
            $i++;
        }
        $value = serialize($cartItems);

        $cookie = new CHttpCookie('TstCookies', $value);
        $cookie->expire = time() + 60 * 60 * 24;
        Yii::app()->request->cookies['TstCookies'] = $cookie;


        if (!Yii::app()->user->isGuest) {
            $id = Yii::app()->user->id;
            $user = User::model()->findByPk($id);

            $criteria = new CDbCriteria;
            $criteria->select = 't.*';
            $criteria->condition = 'user_id=' . $id;
            $userDetailsData = UserDetails::model()->find($criteria);
        }

        $this->render('cart', array('cart' => $cart,
            'discount' => $discount,
            'model' => $model,
            'shops' => $shops,
            'action' => $action));
//        } else {
//            $this->redirect("index");
//        }
    }

    public function actionCart_drop() {
        $cart = Yii::app()->shoppingCart->getPositions();
        $this->renderPartial('cart_dropdown', array('cart' => $cart));
    }

    public function actionApplycoupon() {
        if (!Yii::app()->user->isGuest) {
            if (isset($_POST['code']) && isset($_POST['shid'])) {
                $discount_code = $_POST['code'];
//echo $discount_code;
///search for it in DB
                $criteria = new CDbCriteria();
                $criteria->condition = 'code = "' . $discount_code . '"';
                $criteria->addCondition('shop_id=' . $_POST['shid']);
                $discount = Coupon::model()->find($criteria);
/// if not found
                $status = "error";
                if ($discount) {
                    if ($discount->redem_num <= $discount->used_num) {
                        $status = "error2";
                    } else {
                        $uscs = UserCoupons::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'coupon_id' => $discount->id));
                        if ($uscs) {
                            $status = 'error3';
                        } else {
                            $tdisc = '0';
                            $items = Yii::app()->shoppingCart->getPositions();
                            foreach ($items as $item) {
                                if ($item->shop_id == $discount->shop_id) {
                                    $rate = '1';
                                    if (!Yii::app()->user->isGuest) {
                                        $rate = Yii::app()->user->getState('currency_rate');
                                    }
                                    $disc = $discount->discount * $rate;
                                    if (!$discount->type) {
                                        $disc = ($item->getPrice() * ($discount->discount / 100)) * $rate;
                                    }

                                    $_SESSION['shop_discount_' . $item->shopName->id] = $disc;

                                    $usc = new UserCoupons;
                                    $usc->user_id = Yii::app()->user->id;
                                    $usc->coupon_id = $discount->id;
                                    $usc->save(false);
                                }
                            }
                            $discount->used_num = $discount->used_num + 1;
                            $discount->save(false);

                            $test = Helper::shopping_cost();

                            $status = 'done';
                        }
                    }
                }
                echo $status;
            }
        }
    }
	
    public function actionSaveShipping() {
		$user_dets = UserDetails::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
		$user_dets->address = $_GET['address'];
		$user_dets->phone_no = $_GET['phone'];
		$user_dets->country_id = $_GET['country'];
		if($user_dets->save(false))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

    public function actionCheckout() {
        if (!Yii::app()->user->isGuest) {

            $country_flag = false;
            $country = "";
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR']));
			
            if ($ip_data && $ip_data->geoplugin_countryName != null) {
                $country = $ip_data->geoplugin_countryName;
            }

            if ($country != "Singapore") {
                $country_flag = true;
            }

            $user_dets = UserDetails::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

            $model = new Orders('chk');

            $model->first_name = Yii::app()->user->getState('fname');
            $model->last_name = Yii::app()->user->getState('lname');
            $model->email = Yii::app()->user->getState('email');
            $model->address = $user_dets->address;
            $model->phone = $user_dets->phone_no;
            $model->country_id = $user_dets->country_id ? $user_dets->country_id : 189;

            if (isset($_POST['Orders'])) {

                $rate = '1';
                $curr_code = Yii::app()->params['dc_code'];
                if (!Yii::app()->user->isGuest) {
                    $curr_code = Yii::app()->user->getState('currency_code');
                    $rate = Yii::app()->user->getState('currency_rate');
                }

                $model->attributes = $_POST['Orders'];
                if ($_POST['type'] == "paypal") {

                    $paymentInfo['Order']['theTotal'] = Helper::shopping_cost();
                    $paymentInfo['Order']['description'] = 'Wherewestyle Payment';
                    Yii::app()->Paypal->currency = $curr_code;
                    $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
                    if (Yii::app()->Paypal->isCallSucceeded($result)) {

                        $token = urldecode($result["TOKEN"]);
                        $model->user_id = Yii::app()->user->id;
                        $model->token = $token;
                        $us = User::model()->findByPk(Yii::app()->user->id);
                        $model->username = $us->username;
                        $model->total = Helper::shopping_cost();
                        $model->currency_rate = $rate;
                        $model->payment_method = 1;
                        $model->order_date = date('Y-m-d');
                        if ($model->save(false)) {
                            $items = Yii::app()->shoppingCart->getPositions();
                            foreach ($items as $item) {
                                $order_details = new OrderDetails;
                                $order_details->user_id = Yii::app()->user->id;
                                $order_details->order_id = $model->id;
                                $order_details->product_id = $item->id;
                                $order_details->create_time = date('M j , Y - h i s', time());
                                $order_details->qty = $item->getQuantity();
                                $tmp = '0';
                                if (isset($_SESSION['shop_discount_' . $item->shop_id])) {
                                    $tmp = $_SESSION['shop_discount_' . $item->shop_id];
                                }

                                $order_details->cost = ($item->price * $rate) - $tmp;
                                $order_details->save(false);
								Helper::create_notif($order_details->product->shopName->seller_id, '4', Yii::app()->user->id);
                            }
                            $payPalURL = Yii::app()->Paypal->paypalUrl . $token . '&Order=' . $model->id;
                            $this->redirect($payPalURL);
                        }
                    }
                } else if ($_POST['type'] == "bank_transfer") {

                    if ($model->save(false)) {
                        $this->redirect(array("bank_transfer", "order" => $model->id));
                    }
                }
				
            }
            $this->render('checkout', array('model' => $model, "country" => $country, 'country_flag' => $country_flag, 'user_dets' => $user_dets));
        } else {
            $this->redirect("shoppingCart");
        }
    }

    public function actionBank_transfer($order) {
        if (!Yii::app()->user->isGuest) {
            $country = "";
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR']));

            if ($ip_data && $ip_data->geoplugin_countryName != null) {
                $country = $ip_data->geoplugin_countryName;
            }

            if ($country != "Singapore") {
                $ord = Orders::model()->findByPk($order);
                if ($ord) {
                    $rate = '1';
                    $curr_code = Yii::app()->params['dc_code'];
                    if (!Yii::app()->user->isGuest) {
                        $curr_code = Yii::app()->user->getState('currency_code');
                        $rate = Yii::app()->user->getState('currency_rate');
                    }

                    $model = new BankTransfers('bnkt');
                    $banks = Banks::model()->findAllByAttributes(array('status' => 1));
                    $from_banks = FromBanks::model()->findAll();

                    if (isset($_POST['BankTransfers'])) {
                        $model->attributes = $_POST['BankTransfers'];

                        $rnd = rand(0, 99998999);  // generate random number between 0-9999
                        $uploadedFile = CUploadedFile::getInstance($model, 'receipt');


                        if (!empty($uploadedFile)) {
                            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                            $model->receipt = $fileName;
                            $uploadedFile->saveAs(Yii::app()->basePath . '/../media/receipts/' . $fileName);
                        }

                        $model->order_id = $order;
                        $model->date = date("Y-m-d");

                        if ($model->save()) {

                            $ord->user_id = Yii::app()->user->id;
                            $us = User::model()->findByPk(Yii::app()->user->id);
                            $ord->username = $us->username;
                            $ord->total = Helper::shopping_cost();
                            $ord->currency_rate = $rate;
                            $ord->payment_method = 2;
                            $ord->order_date = date('Y-m-d');
                            if ($ord->save(false)) {
                                $items = Yii::app()->shoppingCart->getPositions();
                                foreach ($items as $item) {
                                    $order_details = new OrderDetails;
                                    $order_details->user_id = Yii::app()->user->id;
                                    $order_details->order_id = $ord->id;
                                    $order_details->product_id = $item->id;
                                    $order_details->create_time = date('M j , Y - h i s', time());
                                    $order_details->qty = $item->getQuantity();
                                    $tmp = '0';
                                    if (isset($_SESSION['shop_discount_' . $item->shop_id])) {
                                        $tmp = $_SESSION['shop_discount_' . $item->shop_id];
                                    }

                                    $order_details->cost = ($item->price * $rate) - $tmp;
                                    $order_details->save(false);
									Helper::create_notif($order_details->product->shopName->seller_id, '4', Yii::app()->user->id);
                                }
                            }

                            Yii::app()->shoppingCart->clear();

                            Yii::app()->user->setFlash('status', 'transaction details submitted');

                            $this->redirect(array('transaction_submitted'));
                        }
                    }

                    $this->render("bank_transfer", array('banks' => $banks, 'model' => $model, 'from_banks' => $from_banks));
                } else {
                    throw new CHttpException(404, "this page doesn't exist");
                }
            } else {
                $this->redirect(array("checkout"));
            }
        } else {
            $this->redirect(array("index"));
        }
    }

    public function actionTransaction_submitted() {
        if (Yii::app()->user->hasFlash('status')) {
            $this->render('transaction_submitted');
        } else {
            $this->redirect(array("index"));
        }
    }

    public function actionConfirm() {
        if (!Yii::app()->user->isGuest) {
            $token = trim($_GET['token']);
            $payerId = trim($_GET['PayerID']);
            $criteria = new CDbCriteria;
            $criteria->condition = 'token=:Tokenw';
            $criteria->params = array(':Tokenw' => $token);
            $orders = Orders::model()->find($criteria);
            $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
            $result['PAYERID'] = $payerId;
            $result['TOKEN'] = $token;
            $result['ORDERTOTAL'] = $orders->price;
//Detect errors
            if (!Yii::app()->Paypal->isCallSucceeded($result)) {
                if (Yii::app()->Paypal->apiLive === true) {
//Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
//Sandbox output the actual error message to dive in.
                    $error = $result['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
//Detect errors
                if (!Yii::app()->Paypal->isCallSucceeded($paymentResult)) {
                    if (Yii::app()->Paypal->apiLive === true) {
                        //Live mode basic error message
                        $error = 'We were unable to process your request. Please try again later';
                    } else {
                        //Sandbox output the actual error message to dive in.
                        $error = $paymentResult['L_LONGMESSAGE0'];
                    }
                    echo $error;
                    Yii::app()->end();
                } else {
//payment was completed successfully
                    if ($orders->status_id == '4') {
                        $orders->status_id = '1';
                        $orders->save(false);

                        $ids = array();
                        $ordd = OrderDetails::model()->findAllByAttributes(array('order_id' => $orders->id));
                        if ($ordd) {
                            foreach ($ordd as $od) {
                                $od->product->sales_count += 1;
                                $od->product->save(false);
                                if (!in_array($od->product->shopName->seller_id, $ids)) {
                                    Helper::create_notif($od->product->shopName->seller_id, '5', Yii::app()->user->id);
                                    $ids[] = $od->product->shopName->seller_id;

                                    $od->product->shopName->transaction_count += 1;
                                    $od->product->shopName->save(false);
                                }
                            }
                        }
						Helper::create_notif(Yii::app()->user->id, '3');

                        // need to clear cart
                        Yii::app()->shoppingCart->clear();
                    }
                    $this->render('confirm', array('orders' => $orders));
                }
            }
        } else {
            throw new CHttpException(404, "this page doesn't exist");
        }
    }

    public function actionCancel() {
//The token of the cancelled payment typically used to cancel the payment within your application
        $token = trim($_GET['token']);
//  $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Tokenw';
        $criteria->params = array(':Tokenw' => $token);
        $orders = Orders::model()->find($criteria);
        if ($orders->status_id == '4') {
            $orders->status_id = '2';
            $orders->save();
// need to clear cart
//Yii::app()->shoppingCart->clear();
        }
        $this->render('cancel');
    }

//------------------------------------------------------------------------------------------

    public function actionProductDetails() {

        $curr_symbol = Yii::app()->params['dc_symbol'];
        $rate = '1';
        if (!Yii::app()->user->isGuest) {
            $curr_symbol = Yii::app()->user->getState('currency_symbol');
            $rate = Yii::app()->user->getState('currency_rate');
        }
       
        $slug = $_REQUEST['slug'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'slug=:slug';
        $criteria->params = array(':slug' => $slug);
        $criteria->addCondition('active = 1');
        $model = Product::model()->find($criteria);
        Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl . '/media/products/original/' . $model->main_image, 'image');
        Yii::app()->clientScript->registerMetaTag($model->title, 'title');
        Yii::app()->clientScript->registerMetaTag($curr_symbol.' '.$model->price * $rate.' '.$model->desc, 'description');

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
			
		Yii::app()->clientScript->registerMetaTag($model->title, 'og:title');
		Yii::app()->clientScript->registerMetaTag($model->desc, 'og:description');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->request->getBaseUrl('webroot')."/home/productDetails/".$model->slug, 'og:url');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl('webroot')."/media/products/original/".$product->main_image, 'og:image');

        $criteria = new CDbCriteria();
        $criteria->condition = 'gallery_id=:UID';
        $criteria->params = array(':UID' => $model->gallery_id);
        $criteria->order = 'rank';
        $criteria->limit = 3;
        $gallery = GalleryPhoto::model()->findAll($criteria);

        $criteria1 = new CDbCriteria;
        $criteria1->condition = 'shop_id=' . $model->shop_id;
        $criteria1->addCondition('id != ' . $model->id);
        $criteria1->order = 'RAND()';
        $criteria1->limit = 8;
        $sim = Product::model()->findAll($criteria1);
		

        $this->render('productdetails', array('model' => $model, 'gallery' => $gallery, 'similar' => $sim));
    }

//------------------------------------------------------------------------------------------

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-feedback-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

//===============static page==============
    public function actionPage() {
        $slug = $_REQUEST['slug'];


        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'url=:slug';
        $criteria->params = array(':slug' => $slug);
        $pages = Pages::model()->find($criteria);
        $this->render('staticpage', array('pages' => $pages));
    }

    public function actionAutosearch() {
        if (isset($_GET['term'])) {

//products
            $sql = 'SELECT id , title as value FROM `product` WHERE LOWER(title) LIKE :qterm OR LOWER(`desc`) LIKE :qterm ';
            $sql .= ' ORDER BY title ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = '%' . $_GET['term'] . '%';
            $command->bindParam(":qterm", strtolower($qterm), PDO::PARAM_STR);
            $result = $command->queryAll();
//shops
//            $sql2 = 'SELECT id , title as value FROM `shop` WHERE title LIKE :qterm ';
//            $sql2 .= ' ORDER BY title ASC LIMIT 5';
//            $command2 = Yii::app()->db->createCommand($sql2);
//            $qterm2 = '%' . $_GET['term'] . '%';
//            $command2->bindParam(":qterm", $qterm2, PDO::PARAM_STR);
//            $result2 = $command2->queryAll();
////users
//            $sql3 = 'SELECT id , username as value FROM `user` WHERE username LIKE :qterm ';
//            $sql3 .= ' ORDER BY username ASC LIMIT 5';
//            $command3 = Yii::app()->db->createCommand($sql3);
//            $qterm3 = '%' . $_GET['term'] . '%';
//            $command3->bindParam(":qterm", $qterm3, PDO::PARAM_STR);
//            $result3 = $command3->queryAll();
//            echo CJSON::encode(array_merge(array_merge($result, $result2), $result3));
            echo CJSON::encode($result);
        }
    }

    public function actionBrowse() {
        $slug = $_REQUEST['slug'];
        $cat_id = $_REQUEST['id'];
        //echo $slug; die;
        //echo count($category); die;
        $this->layout = 'pagination_layout';
        $criteria = new CDbCriteria;
        $criteria->condition = 'active=1';
        if($slug){
            $category = Category::model()->find_by_slug($slug);
            $cat_id = $category->id;
            if ($slug != "All") {
                $criteria->addCondition('cat_id=' . $category->id);
            }
        }
        if($cat_id){
            $criteria->addCondition('cat_id=' . $cat_id);
        }
        
        $criteria->order = "id DESC";
        $pages = '';

        if ($_GET['flag'] != "express") {
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = 8;
            $pages->applyLimit($criteria);
        }

        $products = Product::model()->findAll($criteria);

        $view = '_products_grid';
        if ($_GET['flag'] == 'list') {
            $view = '_products_list';
        } else if ($_GET['flag'] == 'express') {
            $view = 'express';
        }

        $this->render('browse', array('products' => $products, 'cid' => $cat_id, 'view' => $view, 'pages' => $pages));
    }

    public function actionListingcp($id = 0) {
        $products = Product::model()->findAllByAttributes(array('cat_id' => $id));
        if ($_REQUEST['flag'] == 'grid') {
            $list = $this->renderPartial('_products_grid', array('products' => $products, 'sale' => false, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'list') {
            $list = $this->renderPartial('_products_list', array('products' => $products, 'sale' => false, 'show_shop' => true));
            echo $list;
        } elseif ($_REQUEST['flag'] == 'express') {
            $list = $this->renderPartial('express', array('products' => $products, 'sale' => true, 'show_shop' => true));
            echo $list;
        }
    }

    public function actionExpress() {
        $this->render('express');
    }

    public function actionDataEntry() {
// $this->render('express');
        $products = Product::model()->findAll();
        for ($i = 50; $i < 60; $i++) {
            foreach ($products as $pro) {
                $model = new Product;
                $model->title = $pro->title;
                $model->desc = $pro->desc;
                $model->main_image = $pro->main_image;
                $model->meta = $pro->meta;
                $model->price = $pro->price;
                $model->stock = $pro->stock;
                $model->sold = $pro->sold;
                $model->start_date = $pro->start_date;
                $model->cat_id = $pro->cat_id;
                $model->shop_id = $pro->shop_id;
                $model->slug = $pro->slug;
                $model->intro = $pro->intro;
                $model->auto_delete = $pro->auto_delete;
                $model->featured = $pro->featured;
                $model->sale = $pro->sale;
                $model->active = $pro->active;
                $model->save(false);
            }
        }
    }

    public function actionUpdate_favourite() {
        $str = "z";
        if (!Yii::app()->user->isGuest) {
            $str = $this->renderPartial('favourite_bar');
        }
        echo $str;
    }

    public function actionUser($username) {
        $model = User::model()->findByAttributes(array('username' => $username));

        if ($model === null) {
            throw new CHttpException(404, "the page you requested doesn't exist");
        }

        $message = new Messages;

        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . $model->id . ',%" OR followers LIKE "%,' . $model->id . ',%" OR followers LIKE "%,' . $model->id . '" OR followers LIKE "' . $model->id . '";');
        $shops = '';

        if ($shops_ids) {
            $ids = array();
            foreach ($shops_ids as $id) {
                $ids[] = $id->shop_id;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);
            $criteria->limit = 4;

            $shops = Shop::model()->findAll($criteria);
        }

        $o_shop = Shop::model()->findByAttributes(array('seller_id' => $model->id));
        if ($o_shop) {
            $oshops = FollowShop::model()->findByAttributes(array('shop_id' => $o_shop->id));
            if ($oshops) {
                $uids = explode(',', $oshops->followers);
                $criteria = new CDbCriteria();
                $criteria->addInCondition('id', $uids);
                $criteria->limit = 4;
                $f_users = User::model()->findAll($criteria);
            }
        }

        $this->render('user_profile', array('model' => $model, 'message' => $message, 'followed_shops' => $shops, 'f_users' => $f_users));
    }

    public function actionAll_followed() {
		$id=0;
		$slug=$_REQUEST['slug'];
		$id=Shop::model()->find(array('condition'=>'slug="'.$slug.'"'))->seller_id;
        $this->layout = 'pagination_layout';
        if ($id) {
            $model = User::model()->findByPk($id);
            if ($model) {
                $o_shop = Shop::model()->findByAttributes(array('seller_id' => $model->id));

                $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . $model->id . ',%" OR followers LIKE "%,' . $model->id . ',%" OR followers LIKE "%,' . $model->id . '" OR followers LIKE "' . $model->id . '";');
                $shops = '';

                if ($shops_ids) {
                    $ids = array();
                    foreach ($shops_ids as $id) {
                        $ids[] = $id->shop_id;
                    }
                    $criteria = new CDbCriteria();
                    $criteria->addInCondition('id', $ids);

                    $count = Shop::model()->count($criteria);
                    $pages = new CPagination($count);

                    $pages->pageSize = 8;
                    $pages->applyLimit($criteria);

                    $shops = Shop::model()->findAll($criteria);
                }

                $this->render("all_followed", array("shops" => $shops, "pages" => $pages, "user" => $model, 'model' => $o_shop));
            } else {
                throw new CHttpException(404, "This page doesn't exist");
            }
        } else {
            $this->redirect(array("index"));
        }
    }

    public function actionAll_followers() {
		$id=0;
		$slug=$_REQUEST['slug'];
		$id=Shop::model()->find(array('condition'=>'slug="'.$slug.'"'))->seller_id;
        $this->layout = 'pagination_layout';
        if ($id) {
            $model = User::model()->findByPk($id);
            if ($model) {
                $o_shop = Shop::model()->findByAttributes(array('seller_id' => $model->id));
                if ($o_shop) {
                    $oshops = FollowShop::model()->findByAttributes(array('shop_id' => $o_shop->id));
                    if ($oshops) {
                        $uids = explode(',', $oshops->followers);
                        $criteria = new CDbCriteria();
                        $criteria->addInCondition('id', $uids);

                        $count = User::model()->count($criteria);
                        $pages = new CPagination($count);

                        $pages->pageSize = 8;
                        $pages->applyLimit($criteria);

                        $f_users = User::model()->findAll($criteria);
                    }
                    $this->render("all_followers", array("users" => $f_users, "pages" => $pages, "user" => $model, 'model' => $o_shop));
                } else {
                    throw new CHttpException(404, "This page doesn't exist");
                }
            } else {
                throw new CHttpException(404, "This page doesn't exist");
            }
        } else {
            $this->redirect(array("index"));
        }
    }

    public function actionAbout_us() {
        $this->render('about');
    }

    public function actionChange_curr() {
        if (!Yii::app()->user->isGuest) {
            if ($_POST['curr']) {
                $old_rate = Yii::app()->user->getState('currency_rate');
                $new_rate = "1";
                if ($_POST['curr'] == "SGD") {
                    Yii::app()->user->setState('currency_code', Yii::app()->params['dc_code']);
                    Yii::app()->user->setState('currency_symbol', Yii::app()->params['dc_symbol']);
                    Yii::app()->user->setState('currency_rate', '1');
                    Yii::app()->user->setState('currency_icon', 'sing_flag.gif');
                } else {

                    $curr = Currency::model()->findByAttributes(array("iso_code" => $_POST['curr']));

                    if ($curr) {
                        Yii::app()->user->setState('currency_code', $curr->iso_code);
                        Yii::app()->user->setState('currency_rate', $curr->rate);
                        Yii::app()->user->setState('currency_symbol', $curr->symbol);
                        Yii::app()->user->setState('currency_icon', $curr->icon);
                        $new_rate = $curr->rate;
                    } else {
                        Yii::app()->user->setState('currency_code', Yii::app()->params['dc_code']);
                        Yii::app()->user->setState('currency_symbol', Yii::app()->params['dc_symbol']);
                        Yii::app()->user->setState('currency_rate', '1');
                        Yii::app()->user->setState('currency_icon', 'sing_flag.gif');
                    }
                }
                Helper::update_rate($old_rate, $new_rate);
                if ($_POST['url']) {
                    $this->redirect($_POST['url']);
                } else {
                    $this->redirect(array("index"));
                }
            }
        }
    }

    public function actionProduct_cron() {
        $prods = Product::model()->findAll();
        if ($prods) {
            foreach ($prods as $pr) {
                if ($pr->end_date) {
                    if (time() >= $pr->end_date) {
                        $pr->delete();
                    }
                }
            }
        }
    }
	
    public function actionUpdateUserSharing($id)
    {
        $val=!$id;
        Yii::app()->user->setState('fb_sharing', $val);
        $model=User::model()->findByPk(Yii::app()->user->id);
        $model->fb_sharing=$val;
        $model->password=$model->simple_decrypt($model->password);
        $model->save(false);
    }
	
    public function actionSetFind()
    {
        Yii::app()->user->setState('fb_find','1');
    }
}
