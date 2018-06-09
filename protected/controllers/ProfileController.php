<?php

class ProfileController extends FrontController {

    protected function beforeAction($action) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array("home/index"));
        }
        return parent::beforeAction($action);
    }

    /* ------------------------profile information section--------------------- */

    public function actionIndex() {
        $model = User::model()->findByPk(Yii::app()->user->id);

        if ($_REQUEST['oauth_token'] && Yii::app()->session['oauth_token'] && Yii::app()->session['oauth_token_secret']) {

            $twitter = Yii::app()->twitter->getTwitterTokened(Yii::app()->session['oauth_token'], Yii::app()->session['oauth_token_secret']);
            $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
			
			//Yii::app()->session['access_token'] = $access_token; /*test*/
			
            $model->twitter_token = $access_token['oauth_token'];
            $model->twitter_token_secret = $access_token['oauth_token_secret'];
            $model->password = $model->simple_decrypt($model->password);
            $r = $model->save(false);
			
            unset(Yii::app()->session['oauth_token']);
            unset(Yii::app()->session['oauth_token_secret']);
        }

        $user = Yii::app()->facebook->getUser();

        if ($user) {
            if ($_GET['code']) {
                $model->facebook_id = $user;
                $model->password = $model->simple_decrypt($model->password);
                $model->save(false);
            }
        }

        $twuser = '';
        if ($model->twitter_token && $model->twitter_token_secret) {

            $twitter = Yii::app()->twitter->getTwitterTokened($model->twitter_token, $model->twitter_token_secret);
            $twuser = $twitter->get("account/verify_credentials");
        }
		/*if($_GET['oauth_token'] && $_GET['oauth_verifier']) //to redirect twitte calls
		{
			$this->redirect(array('settings'));
		}*/

        $this->render('profile', array('model' => $model, 'user' => $user, 'twuser' => $twuser));
    }

    public function actionSettings() {
        $model = User::model()->findByPk(Yii::app()->user->id);


        if (Yii::app()->session['oauth_token'] && Yii::app()->session['oauth_token_secret']) {

            $twitter = Yii::app()->twitter->getTwitterTokened(Yii::app()->session['oauth_token'], Yii::app()->session['oauth_token_secret']);
            $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
            $model->twitter_token = $access_token['oauth_token'];
            $model->twitter_token_secret = $access_token['oauth_token_secret'];
            $model->password = $model->simple_decrypt($model->password);
            $r = $model->save(false);
            unset(Yii::app()->session['oauth_token']);
            unset(Yii::app()->session['oauth_token_secret']);
        }

        $user = Yii::app()->facebook->getUser();

        if ($user) {
			//echo $user;die;
            if ($_GET['code']) {
				//var_dump($user);die;
                $model->facebook_id = $user;
		$us_info=Yii::app()->facebook->getInfoById($user);
		$model->facebook=$us_info['name'];
                $model->password = $model->simple_decrypt($model->password);
                $model->save(false);
            }
        }

        $twuser = '';
        if ($model->twitter_token && $model->twitter_token_secret) {

            $twitter = Yii::app()->twitter->getTwitterTokened($model->twitter_token, $model->twitter_token_secret);
            $twuser = $twitter->get("account/verify_credentials");
        }


        if (isset($_POST['User'])) {
            if ($model->image != '') {
                $_POST['User']['image'] = $model->image;
            }
            $model->attributes = $_POST['User'];

            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                $rnd = rand(0, 9999);
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/original/' . $model->image);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/members/original/' . $model->image);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/members/thumbs_266X300/' . $model->image);
            }

            //CVarDumper::dump($_POST['allowed'],10,1);die;
            if (isset($_POST['allowed'])) {
                $model->allowed_notifs = implode($_POST['allowed']['site'], ',');
                $model->allowed_email_notifs = implode($_POST['allowed']['email'], ',');
            } else {
                $model->allowed_notifs = '';
            }

            if ($model->save()) {
                $curr = Currency::model()->findByPk($model->currency);

                $old_rate = '1';
                if (!Yii::app()->user->isGuest) {
                    $old_rate = Yii::app()->user->getState('currency_rate');
                }
                $new_rate = "1";

                if ($curr) {
                    Yii::app()->user->setState('currency_code', $curr->iso_code);
                    Yii::app()->user->setState('currency_rate', $curr->rate);
                    Yii::app()->user->setState('currency_symbol', $curr->symbol);
                    $new_rate = $curr->rate;
                } else {
                    Yii::app()->user->setState('currency_code', Yii::app()->params['dc_code']);
                    Yii::app()->user->setState('currency_symbol', Yii::app()->params['dc_symbol']);
                    Yii::app()->user->setState('currency_rate', '1');
                }
                Helper::update_rate($old_rate, $new_rate);
                $this->redirect(array('index'));
            }
        }

        $model->password = $model->password_repeat = $model->simple_decrypt($model->password);
        $this->render('settings', array('model' => $model, 'user' => $user, 'twuser' => $twuser));
    }

    /* ----------------------------purchasing section-------------------------- */

    public function actionOrders() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . Yii::app()->user->id;
        $orders = Orders::model()->findAll($criteria);
        $this->render('orders', array('orders' => $orders));
    }

    public function actionOrderDetails($id) {
        $order = Orders::model()->findByPk($id);
        if ($order === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        $criteria = new CDbCriteria;
        $criteria->condition = 'order_id=' . $id;
        $order_details = OrderDetails::model()->findAll($criteria);

        $message = new Messages;

        $this->render('orderdetails', array('order_details' => $order_details, 'parent_order' => $order, 'message' => $message));
    }

    /* -----------------------------messages section--------------------------- */

    public function actionMessages() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'reciever_id=' . Yii::app()->user->id;
        $all_mess = Messages::model()->findAll($criteria);

        $mids = array();

        if ($all_mess) {
            foreach ($all_mess as $ms) {
                if ($ms->parent_id) {
                    if (!in_array($ms->parent_id, $mids)) {
                        $mids[] = $ms->parent_id;
                    }
                } else {
                    $mids[] = $ms->id;
                }
            }
        }

        $criteria1 = new CDbCriteria();
        $criteria1->addInCondition('id', $mids);
        $criteria1->order = 'date DESC';
        $messages = Messages::model()->findAll($criteria1);

        $this->render('messages', array('messages' => $messages));
    }

    public function actionCreatemessage() {
        $model = new Messages;
        if (isset($_POST['Messages'])) {
            $model->attributes = $_POST['Messages'];
            $model->sender_id = Yii::app()->user->id;
            $model->date = time();
            $model->last_update = time();
            if ($model->save(false)) {
                Helper::create_notif($model->reciever_id, '3', $model->id);
            }
        } else {
            echo 'wrong';
        }
    }

    public function actionViewmessage($id) {
        $model = Messages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->status = '1';
        $model->save(false);

        $criteria = new CDbCriteria;
        $criteria->condition = 'parent_id=' . $model->id;
        $replies = Messages::model()->findAll($criteria);

        $new = new Messages;

        if (isset($_POST['Messages'])) {
            $new->attributes = $_POST['Messages'];
            $new->sender_id = Yii::app()->user->id;
            $new->parent_id = $id;
            $new->date = time();
            $new->last_update = time();
            $new->reciever_id = $model->sender_id;
            if ($model->sender_id == Yii::app()->user->id) {
                $new->reciever_id = $model->reciever_id;
            }
            if ($new->save(false))
                $this->refresh();
        }

        $this->render('messagedetails', array('message' => $model, 'replies' => $replies, 'new' => $new));
    }

    public function actionDeletemessage($id) {
        $model = Messages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (!$model->parent_id) {
            Messages::model()->deleteAllByAttributes(array('parent_id' => $model->id,));
        }
        $model->delete();
        $this->redirect(array('messages'));
    }

    /* ------------------------------shops section----------------------------- */

    public function actionShop() {

        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }
        $model = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (isset($_POST['Shop'])) {
            if ($model->image != '') {
                $_POST['Shop']['image'] = $model->image;
            }
            if ($model->banner != '') {
                $_POST['Shop']['banner'] = $model->banner;
            }

            $tmp_sale = $model->store_wide_sale;

            $model->attributes = $_POST['Shop'];
            //$model->slug = Helper::slugify($model->title);
            $model->seller_id = Yii::app()->user->id;
            $model->active = '1';


            $rnd = rand(0, 9999);
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $rnd2 = rand(0, 9999);
            $uploadedFile2 = CUploadedFile::getInstance($model, 'banner');
            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/shops/thumbs_266X300/' . $fileName);
            }
            if (!empty($uploadedFile2)) {
                $fileName2 = "{$rnd2}-{$uploadedFile2}";
                $model->banner = $fileName2;
                $uploadedFile2->saveAs(Yii::app()->basePath . '/../media/shops/banner/' . $fileName2);
            }

            if (!$_POST['sale_check']) {
                $model->store_wide_sale = 0;
            }

            if ($model->save()) {
                //when the store-wide sale changed
                if ($tmp_sale != $model->store_wide_sale) {

                    $products = Product::model()->findAll(array('condition' => 'shop_id = ' . $model->id));
                    if ($model->store_wide_sale != 0) {

                        //update the price of shop products that don't have sale
                        foreach ($products as $product) {

                            if ($product->sale) {
                                $product->other_old_price = $product->price;
                                $product->price = $product->old_price;
                            }
                            $product->sale = 1;
                            $product->old_price = $product->price;
                            $product->price = $product->price - ($product->price * $model->store_wide_sale / 100);
                            $product->save(false);
                        }
                    } else {
                        //update the price of shop products to remove the sale
                        foreach ($products as $product) {
                            if ($product->sale) {
                                if ($product->other_old_price) {
                                    $product->price = $product->other_old_price;
                                    $product->sale = 1;
                                } else {
                                    $product->price = $product->old_price;
                                    $product->sale = 0;
                                    $product->old_price = 0;
                                }
                                $product->save(false);
                            }
                        }
                    }
                }
                $this->redirect(array('shop'));
            }
        }
        $this->render('shop_form', array('model' => $model));
    }

    public function actionCreateshop() {

        $model = new Shop;
        if (isset($_POST['Shop'])) {
            $model->attributes = $_POST['Shop'];
            //$model->slug = Helper::slugify($model->title);
            $model->seller_id = Yii::app()->user->id;
            $model->active = '1';
            $rnd = rand(0, 9999);
            $rnd2 = rand(0, 9999);
            $uploadedFile = CUploadedFile::getInstance($model, 'image');
            $uploadedFile2 = CUploadedFile::getInstance($model, 'banner');
            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/shops/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/shops/thumbs_266X300/' . $fileName);
            }
            if (!empty($uploadedFile2)) {
                $fileName2 = "{$rnd2}-{$uploadedFile2}";
                $model->banner = $fileName2;
                $uploadedFile2->saveAs(Yii::app()->basePath . '/../media/shops/banner/' . $fileName2);
            }

            if (!$_POST['sale_check']) {
                $model->store_wide_sale = 0;
            }

            if ($model->save(false)) {
                $usr = User::model()->findByPk(Yii::app()->user->id);
                if ($usr->groups_id != 6) {
                    $usr->groups_id = 2;
                    $usr->password = $usr->simple_decrypt($usr->password);
                    if($usr->save(false)){
						Yii::app()->user->setState('group', '2');
						$fb_frs=UserFacebookFriends::model()->findAll(array('condition','user_id='.$usr->id));
						if($fb_frs){
							foreach($fb_frs as $fr)
							{
								$fr_arr[]=$fr->facebook_fr_id;
							}
							$wws_fb_fr=User::model()->findAll(array('condition'=>'facebook_id in ('.implode(',',$fr_arr).')'));
							if($wws_fb_fr)
							{
								foreach($wws_fb_fr as $fr_fb)
								{
									Helper::create_notif($usr->id,'2',$fr_fb->id);
								}
							}
						}
					}
                }
                $this->redirect(array('shop'));
            }
        }
        $this->render('shop_form', array('model' => $model));
    }

    public function actionDelete_shop() {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $model = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $products = Product::model()->findAllByAttributes(array('shop_id' => $model->id,));

        if ($products) {
            foreach ($products as $prod) {
                OrderDetails::model()->deleteAllByAttributes(array('product_id' => $prod->id,));
                FollowProduct::model()->deleteAllByAttributes(array('pro_id' => $model->id,));
                FavouriteProduct::model()->deleteAllByAttributes(array('pro_id' => $model->id,));
            }
        }

        Product::model()->deleteAllByAttributes(array('shop_id' => $model->id,));

        Coupon::model()->deleteAllByAttributes(array('shop_id' => $model->id,));

        FollowShop::model()->deleteAllByAttributes(array('shop_id' => $model->id,));

        FavouriteShop::model()->deleteAllByAttributes(array('shop_id' => $model->id,));

        $usr = User::model()->findByPk(Yii::app()->user->id);
        if ($usr->groups_id != 6) {
            $usr->groups_id = 1;
            $usr->password = $usr->simple_decrypt($usr->password);
            $usr->save(false);
            Yii::app()->user->setState('group', '1');
        }

        $model->delete();

        $this->redirect(array('index'));
    }

    public function actionProducts() {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $model = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $criteria = new CDbCriteria;
        $criteria->condition = 'shop_id=' . $model->id;
        $products = Product::model()->findAll($criteria);

        $this->render('shopdetails', array('model' => $model, 'products' => $products));
    }

    public function actionCreateproduct() {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }
        $shop = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id));
        if ($shop === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $temp3 = $shop->store_wide_sale;
        $model = new Product;
        if ($model->gallery_id == '') {
            $gallery = new Gallery();
            $gallery->name = false;
            $gallery->description = false;
            $gallery->versions = array(
                'small' => array(
                    'resize' => array(200, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery->save();
        }

        if (isset($_POST['Product'])) {

            $rate = Yii::app()->user->getState('currency_rate');

            $model->attributes = $_POST['Product'];

            $model->price = $model->price / $rate;
            if ($model->old_price) {
                $model->old_price = $model->old_price / $rate;
            }

            $model->shop_id = $shop->id;
            $rnd = rand(0, 999999999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->main_image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/products/thumbs_266X300/' . $fileName);
            }

            //$model->slug = Helper::slugify($model->title);
            $model->start_date = date('Y-m-d H:i:s');
            $model->active = '1';

            if ($model->save()) {
				$shopFollowers=explode(',',FollowShop::model()->find(array('condition'=>'shop_id='.$shop->id))->followers);
				foreach($shopFollowers as $sf)
				{
					$Pro_fol=new FollowProNotif;
					$Pro_fol->follower_id=$sf;
					$Pro_fol->pro_id=$model->id;
					$Pro_fol->shop_id=$model->shop_id;
					$Pro_fol->seen="0";
					$Pro_fol->save(false);
				}
				
                $shop->store_wide_sale = 0;
                $shop->last_update = time();
                $shop->save(false);

                if ($temp3) {
                    $products = Product::model()->findAll(array('condition' => 'shop_id = ' . $shop->id . ' and id != ' . $model->id));
                    foreach ($products as $product) {
                        if ($product->sale) {
                            if ($product->other_old_price) {
                                $product->price = $product->other_old_price;
                                $product->sale = 1;
                            } else {
                                $product->price = $product->old_price;
                                $product->sale = 0;
                                $product->old_price = 0;
                            }
                            $product->save(false);
                        }
                    }
                }

                $this->redirect(array('products'));
            }
        }

        $model->gallery_id = $gallery->id;
        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('product_form', array('model' => $model, 'gallery' => $gallery, 'shop_id' => $id, 'store_wide_sale' => $temp3));
    }

    public function actionEditproduct($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');$shop = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id));
        if ($shop === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $sale = $model->sale;
        $t_price = $model->price;
        $t_old_price = $model->old_price;
        $temp3 = $shop->store_wide_sale;

        if (isset($_POST['Product'])) {

            $rate = Yii::app()->user->getState('currency_rate');
            if ($model->main_image != '') {
                $_POST['Product']['main_image'] = $model->main_image;
            }
            $model->attributes = $_POST['Product'];

            //echo $model->end_date."----".strtotime($model->end_date)."---------".date('d/m/Y',strtotime($model->end_date));die;
            //$model->end_date = strtotime($model->end_date);

            $model->price = $model->price / $rate;
            if ($model->old_price) {
                $model->old_price = $model->old_price / $rate;
            }

            $rnd = rand(0, 999999999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->main_image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb = Yii::app()->phpThumb->create(Yii::app()->basePath . '/../media/products/original/' . $fileName);
                $thumb->resize(266, 300);
                $thumb->save(Yii::app()->basePath . '/../media/products/thumbs_266X300/' . $fileName);
            }

            //$model->slug = Helper::slugify($model->title);
            $model->start_date = date('Y-m-d H:i:s');

            if ($model->save(false)) {
                $model->shopName->last_update = time();
                $model->shopName->save(false);

                if($sale != $model->sale || $t_price != $model->price || $t_old_price != $model->old_price){
                    $products = Product::model()->findAll(array('condition' => 'shop_id = ' . $shop->id . ' and id != ' . $model->id));
                    foreach ($products as $product) {
                        if ($product->sale) {
                            if ($product->other_old_price) {
                                $product->price = $product->other_old_price;
                                $product->sale = 1;
                            } else {
                                $product->price = $product->old_price;
                                $product->sale = 0;
                                $product->old_price = 0;
                            }
                            $product->save(false);
                        }
                    }
                }

                $this->redirect(array('products'));
            }
        }

        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('product_form', array('model' => $model, 'gallery' => $gallery, 'store_wide_sale' => $temp3));
    }

    public function actionDeleteproduct($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $model = Product::model()->findByPk($id);
        if ($model->shopName->seller_id == Yii::app()->user->id) {
            if ($model === null)
                throw new CHttpException(404, 'The requested page does not exist.');

            $temp = $model->shop_id;
            OrderDetails::model()->deleteAllByAttributes(array('product_id' => $id,));
            FollowProduct::model()->deleteAllByAttributes(array('pro_id' => $id,));
            FavouriteProduct::model()->deleteAllByAttributes(array('pro_id' => $id,));

            $model->delete();

            $this->redirect(array('products'));
        }else {
            throw new CHttpException(404, "error");
        }
    }

    public function actionActivateproduct($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }
        $return = "error";
        $model = Product::model()->findByPk($id);
        if ($model !== null) {
            if ($model->shopName->seller->id == Yii::app()->user->id) {
                if ($model->active) {
                    $model->active = '0';
                    $return = 'Activate';
                } else {
                    $model->active = '1';
                    $return = 'Deactivate';
                }
                $model->save(false);
            }
        }
        echo $return;
    }

    /* ----------------------------payouts section----------------------------- */

    public function actionPayouts($filter = 'all') {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $shop = Shop::model()->find($criteria);
        if (!$shop) {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $pids = array();

        $criteria = new CDbCriteria();
        $criteria->condition = 'shop_id=' . $shop->id;
        $products = Product::model()->findAll($criteria);

        foreach ($products as $prod) {
            $pids[] = $prod->id;
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'seller_visible=1';
        $criteria->addInCondition('product_id', $pids);
        $criteria->order = 'id DESC';
        $orders = OrderDetails::model()->findAll($criteria);

        if ($filter != 'all') {
            if ($filter == "completed") {

                $com_orders = array();
                if ($orders) {
                    foreach ($orders as $ord) {
                        if ($ord->order->status_id === '1') {
                            $com_orders[] = $ord;
                        }
                    }
                }
                $orders = $com_orders;
            }
        }

        $this->render('payouts', array('orders' => $orders, 'filter' => $filter));
    }

    public function actionDeletepayout($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $model = OrderDetails::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->seller_visible = '0';
        $model->save(false);
        $this->redirect(array('payouts'));
    }

    public function actiondeleteallpayouts($filter = "all") {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $shop = Shop::model()->find($criteria);
        if (!$shop) {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $pids = array();

        $criteria = new CDbCriteria();
        $criteria->condition = 'shop_id=' . $shop->id;
        $products = Product::model()->findAll($criteria);

        foreach ($products as $prod) {
            $pids[] = $prod->id;
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'seller_visible=1';
        $criteria->addInCondition('product_id', $pids);
        $orders = OrderDetails::model()->findAll($criteria);

        if ($orders) {
            foreach ($orders as $order) {
                if ($filter == 'completed') {
                    if ($order->order->status_id == 1) {
                        $order->seller_visible = '0';
                    }
                } else {
                    $order->seller_visible = '0';
                }
                $order->save(false);
            }
        }

        $this->redirect('payouts');
    }

    /* ----------------------------coupons section----------------------------- */

    public function actionCoupons() {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $shop = Shop::model()->find($criteria);
        if (!$shop) {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'shop_id=' . $shop->id;
        $coupons = Coupon::model()->findAll($criteria);

        $new = new Coupon;

        $this->render('coupons', array('coupons' => $coupons, 'new' => $new));
    }

    public function actionDeletecoupon($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $model = Coupon::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        $model->delete();
        $this->redirect(array('coupons'));
    }

    public function actionCreatecoupon() {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $shop = Shop::model()->find($criteria);
        if (!$shop) {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $model = new Coupon;
        if (isset($_POST['Coupon'])) {

            $rate = Yii::app()->user->getState('currency_rate');

            $model->attributes = $_POST['Coupon'];
            $model->shop_id = $shop->id;
            if ($model->type) {
                $model->discount = $model->discount / $rate;
            }
            $model->save(false);
        } else {
            echo 'wrong';
        }
    }

    public function actionEditcoupon($id) {
        if (Yii::app()->user->group != '2') {
            $this->redirect(array("index"));
        }

        $criteria = new CDbCriteria;
        $criteria->condition = 'seller_id=' . Yii::app()->user->id;
        $shop = Shop::model()->find($criteria);
        if (!$shop) {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $model = Coupon::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        if (isset($_POST['Coupon'])) {
            $rate = Yii::app()->user->getState('currency_rate');

            $model->attributes = $_POST['Coupon'];
            if ($model->type) {
                $model->discount = $model->discount / $rate;
            }
            $model->save(false);
        } else {
            echo 'wrong';
        }
    }

    public function actionTw() {
        $twitter = Yii::app()->twitter->getTwitter();
        $request_token = $twitter->getRequestToken();

        //set some session info
        Yii::app()->session['oauth_token'] = $token = $request_token['oauth_token'];
        Yii::app()->session['oauth_token_secret'] = $request_token['oauth_token_secret'];

        if ($twitter->http_code == 200) {
            //get twitter connect url
            $url = $twitter->getAuthorizeURL($token);
            //send them
            $this->redirect($url);
        } else {
            //error here
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionUnconnect_facebook() {
        $model = User::model()->findByPk(Yii::app()->user->id);
        if ($model->facebook_id) {
            $model->password = $model->simple_decrypt($model->password);
            $model->facebook_id = "";
            $model->save(false);
            $this->redirect(array('settings'));
			//$this->redirect(array('index'));
        }
    }

    public function actionUnconnect_twitter() {
        $model = User::model()->findByPk(Yii::app()->user->id);
        if ($model->twitter_token_secret && $model->twitter_token) {
            $model->password = $model->simple_decrypt($model->password);
            $model->twitter_token = "";
            $model->twitter_token_secret = "";
            $model->save(false);
            $this->redirect(array('settings'));
        }
    }

    public function actionGmail() {
        $consumer_key = '374072361204-386h7dhhk139fevfpubaunbdcbfobk8q.apps.googleusercontent.com';
        $consumer_secret = 'tZrMQaI2JlB9kiIsF1mnIz-d';
        $callback = Yii::app()->request->getBaseUrl('webroot')."/profile/inviteGmailFriends";
        $emails_count = '500'; // max-results
        $argarray=array('xoauth_displayname'=>"Wherewestyle");
        $oauth = new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
        $getcontact = new GmailGetContacts();
        $access_token = $getcontact->get_request_token($oauth, false, true, true);

        $model = User::model()->findByPk(Yii::app()->user->id);
        $model->ggl_oauth_token = $access_token['oauth_token'];
        $model->ggl_oauth_secret = $access_token['oauth_token_secret'];
        $model->password = $model->simple_decrypt($model->password);
        $model->save(false);

        $this->redirect('https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token='.$oauth->rfc3986_decode($access_token['oauth_token']));
    }
	
    public function actionInvite_gmail() {
        echo "sdsf"; die;
        if (isset($_POST['gm_frs'])) {
            print_r($_POST['gm_frs']);
            $flag = false;
            foreach ($_POST['gm_frs'] as $gm) {
                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->user->getState('email'), Yii::app()->user->getState("username"));
                $mail->setTo($gm);
                $mail->setSubject('Checkout wherewestyle');

                $message = 'Checkout wherewestyle and follow this link : http://' . Yii::app()->request->getServerName() . "/home";

                $mail->setBody($message);

                if ($mail->send()) {
                    $flag = true;
                }
            }
            if ($flag) {
                Yii::app()->user->setFlash('gm_status', 'Your selected gmail contacts have been invited .');
            }
            $this->redirect(array("index"));
        }
    }
	
    public function actionInviteGmailFriends() {
		$consumer_key = '374072361204-386h7dhhk139fevfpubaunbdcbfobk8q.apps.googleusercontent.com';
		$consumer_secret = 'tZrMQaI2JlB9kiIsF1mnIz-d';
		$callback = Yii::app()->request->getBaseUrl('webroot').'/profile/inviteGmailFriends';
		$emails_count = '500'; // max-results
		$argarray=array('xoauth_displayname'=>"Wherewestyle");
		$model=User::model()->findByPk(Yii::app()->user->id);
		if ($model->ggl_oauth_token) {
			$oauth = new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);

			$request_token = $oauth->rfc3986_decode($_GET['oauth_token']);
			$request_token_secret = $oauth->rfc3986_decode($model->ggl_oauth_secret);
			$oauth_verifier = $oauth->rfc3986_decode($_GET['oauth_verifier']);

			$getcontact_access = new GmailGetContacts();
			$contact_access = $getcontact_access->get_access_token($oauth, $request_token, $request_token_secret, $oauth_verifier, false, true, true);

			$access_token = $oauth->rfc3986_decode($contact_access['oauth_token']);
			$access_token_secret = $oauth->rfc3986_decode($contact_access['oauth_token_secret']);

			$contacts = $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true, $emails_count);
		}
		
		$flag = false;
		if ($contacts) {
                    foreach ($contacts as $k => $a) {
                        $final = end($contacts[$k]);
                        foreach ($final as $email) {
                            if ($email["address"]) {
                                $mail = new YiiMailer();
                                $mail->setFrom($model->email, $model->username);
                                $mail->setTo($email["address"]);
                                $mail->setSubject('Checkout wherewestyle');

                                $message = 'Heyo. I just visited this site Where We Style and I thought that it would be useful for you. It\'s a top online shopping website congregating many E-stores together. Check it out here: http://' . Yii::app()->request->getServerName() . "/home";

                                $mail->setBody($message);

                                if ($mail->send()) {
                                        $flag = true;
                                }
                            }
                        }
                    }
		}
		if ($flag) {
			Yii::app()->user->setFlash('tw_status', 'Your gmail contacts have been invited.');
		}
		$this->redirect(array("settings"));
    }

    public function actionTwi() {
        $twitter = Yii::app()->twitter->getTwitter();
//        $twitter->callback = "http://".Yii::app()->request->getServerName()."/profile/invite_twitter";
        //$request_token = $twitter->getRequestToken("http://" . Yii::app()->request->getServerName() . "/profile/invite_twitter");
	$request_token = $twitter->getRequestToken(Yii::app()->request->getBaseUrl('webroot')."/profile/invite_twitter");

        //set some session info
        Yii::app()->session['oauth_token_inv'] = $token = $request_token['oauth_token'];
        Yii::app()->session['oauth_token_secret_inv'] = $request_token['oauth_token_secret'];

        if ($twitter->http_code == 200) {
            //get twitter connect url
            $url = $twitter->getAuthorizeURL($token);
            //send them
            $this->redirect($url);
        } else {
            //error here
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionInvite_twitter() {
        if ($_REQUEST['oauth_token'] && Yii::app()->session['oauth_token_inv'] && Yii::app()->session['oauth_token_secret_inv']) {
            $twitter = Yii::app()->twitter->getTwitterTokened(Yii::app()->session['oauth_token_inv'], Yii::app()->session['oauth_token_secret_inv']);
		
            $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
            $twitter2 = Yii::app()->twitter->getTwitterTokened($access_token['oauth_token'], $access_token['oauth_token_secret']);
			
            //$result = $twitter2->post('statuses/update', array('status' => "checkout http://" . Yii::app()->request->getServerName() . "/home"));
            $result = $twitter2->post('statuses/update', array('status' => "Heyo. I just visited this site Where We Style and I thought that it would be useful for you. It\'s a top online shopping website congregating many E-stores together. Check it out here: http://".Yii::app()->request->getBaseUrl("webroot")));
            unset(Yii::app()->session['oauth_token_inv']);
            unset(Yii::app()->session['oauth_token_secret_inv']);
            Yii::app()->user->setFlash('tw_status', 'Your twitter friends have been invited.');
            $this->redirect(array("settings"));
        }
    }
    
    public function actionInviteFB(){
		$fb=Yii::app()->facebook;
		$msg="Checkout: " . Yii::app()->request->getBaseUrl("webroot");
        $token=$fb->getAccessToken();
        $fb->setAccessToken($token);
		$url='/me/feed';
		$postedFB=$fb->api($url, 'POST', array('link' => Yii::app()->request->getBaseUrl("webroot"),'message'=>$msg));
		if($postedFB)
		{
			Yii::app()->user->setFlash('tw_status', 'Your Facebook friends have been invited.');
		}
		$this->redirect(array("settings"));
	}
        
    public function actionDeleteimage($id)
    {
        if($id != ''){
            $model= Shop::model()->findByPk($id);
            @unlink(Yii::app()->basePath.'/../media/shops/thumbs_266X300/'.$model->image);
            $dele = Shop::model()->updateByPk($id,array('image'=>''));
            echo "done";
        }
    }
    
    public function actionDeletebannerimage($id)
    {
        if($id != ''){
            $model= Shop::model()->findByPk($id);
            @unlink(Yii::app()->basePath.'/../media/shops/banner/'.$model->banner);
            $dele = Shop::model()->updateByPk($id,array('banner'=>''));
            echo "done";
        }
    }

}
