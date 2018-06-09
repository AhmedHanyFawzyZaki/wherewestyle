<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */
class Helper {

    public static function PlayVideo($model) {
        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->video, 'size' => 'small'));


        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function yiiparam($name, $default = null) {
        if (isset(Yii::app()->params[$name]))
            return Yii::app()->params[$name];
        else
            return $default;
    }

    public static function DrawPageLink($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return 'home/page/view/' . $page->url;
    }

    public static function DrawPageLink2($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return '_' . $page->url;
    }
	
	public static function time_date($date) {
        $str = explode('/', $date);
        return mktime(0, 0, 0, $str[1], $str[0], $str[2]);
    }

    public static function ago($start='',$end='') {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();
		$time=$start;
		$tense = "ago";
		$difference = $now-$time;
		if($end)
		{
                    $time=Helper::time_date($end);
                    $tense = "left";
                    $difference = $time-$now;
		}
        

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] $tense ";
    }
	
	/*public static function ago($time) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference = $now - $time;
        $tense = "ago";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] ago ";
    }*/

    public static function GenerateRandomKey($length = 10) {

        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));

        return $password;
    }

    public static function getGalleryImages($gallery_id) {

        $criteria = new CDbCriteria();

        $criteria->condition = 'gallery_id=:UID';

        $criteria->params = array(':UID' => $gallery_id);
        $criteria->order = 'rank';

        $gallery = GalleryPhoto::model()->findAll($criteria);

        return $gallery;
    }

    public static function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function getStatus($value, $yes, $no) {
        return $value == 0 ? $no : $yes;
    }

    public static function getProductFollowers($product_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'pro_id=' . $product_id;
        $followers = FollowProduct::model()->findAll($criteria);
        $followersNo = '0';
        if ($followers) {
            $followersNo = count(explode(',', $followers->followers));
        }
        return $followersNo;
    }

    public static function getShopFollowers($shop_id, $ct = '') {
        $criteria = new CDbCriteria;
        $criteria->condition = 'shop_id=' . $shop_id;
        $followers = FollowShop::model()->find($criteria);
        $followersNo = '0';
        $str = "Follower";
        if ($followers) {
            $followersNo = count(explode(',', $followers->followers));
            if ($followersNo > 1) {
                $str = "Followers";
            }
        }

        $str2 = $followersNo . " " . $str;

        if ($ct == "shop") {
            $str2 = "Followers: " . $followersNo;
        }

        return $str2;
    }

    public static function getUserFollowers($user_id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . $user_id;
        $followers = FollowUser::model()->find($criteria);
        $followersNo = '0';
        if ($followers) {
            $followersNo = count(explode(',', $followers->followers));
        }
        return $followersNo;
    }

    public static function check_follow_product($pid) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
        $criteria->AddCondition('pro_id=' . $pid);
        $flp = FollowProduct::model()->find($criteria);
        if ($flp) {
            return true;
        } else {
            return false;
        }
    }

    public static function check_favourite_product($pid) {
        if (Yii::app()->user->id) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id = ' . Yii::app()->user->id;
            $criteria->addCondition('pro_id = ' . $pid);
            $flp = FavouriteProduct::model()->find($criteria);
            if ($flp) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function check_follow_shop($sid) {
        if (Yii::app()->user->id) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
            $criteria->AddCondition('shop_id=' . $sid);
            $flp = FollowShop::model()->find($criteria);
            if ($flp) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function check_follow_user($uid) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'followers LIKE "' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . ',%" OR followers LIKE "%,' . Yii::app()->user->id . '" OR followers LIKE "' . Yii::app()->user->id . '"';
        $criteria->AddCondition('user_id=' . $uid);
        $flp = FollowUser::model()->find($criteria);
        if ($flp) {
            return true;
        } else {
            return false;
        }
    }

    public static function shopping_cost() {
        $tdisc = '0';
        $items = Yii::app()->shoppingCart->getPositions();
        foreach ($items as $item) {
            if (isset($_SESSION['shop_discount_' . $item->shop_id])) {
                $disc = $_SESSION['shop_discount_' . $item->shop_id];
                $disc = $item->getQuantity() * $disc;
                $tdisc += $disc;
            }
        }
        $_SESSION['discount'] = $tdisc;

        $rate = '1';
        if (!Yii::app()->user->isGuest) {
            $rate = Yii::app()->user->getState('currency_rate');
        }

        $x = (Yii::app()->shoppingCart->getCost() * $rate) - $_SESSION['discount'];

        return $x;
    }

    public static function update_rate($old_rate, $new_rate) {
        $tdisc = '0';
        $items = Yii::app()->shoppingCart->getPositions();
        foreach ($items as $item) {
            if (isset($_SESSION['shop_discount_' . $item->shop_id])) {
                $_SESSION['shop_discount_' . $item->shop_id] = $_SESSION['shop_discount_' . $item->shop_id] / $old_rate;
                $_SESSION['shop_discount_' . $item->shop_id] = $_SESSION['shop_discount_' . $item->shop_id] * $new_rate;
                $disc = $_SESSION['shop_discount_' . $item->shop_id];
                $disc = $item->getQuantity() * $disc;
                $tdisc += $disc;
            }
        }
        $_SESSION['discount'] = $tdisc;
    }

    public static function create_notif($user_id, $notif_type, $other_id = 0) {
        $user = User::model()->findByPk($user_id);
        $allowed = explode(',', $user->allowed_notifs);
        if (in_array($notif_type, $allowed)) {
            $notif = new Notifications;
            $notif->notif_type = $notif_type;
            $notif->user_id = $user_id;
            $notif->notif_time = date('d-m-Y');
            $notif->other_id = $other_id;
            $notif->save(false);
        }

        $email_allowed = explode(',', $user->allowed_email_notifs);
        if (in_array($notif_type, $email_allowed)) {
            $nott = NotificationType::model()->findByPk($notif_type);

            $mail = new YiiMailer();
            $mail->setFrom(Yii::app()->params['email'], 'Where We Style Mailboy');
            $mail->setTo($user->email);
            $mail->setSubject('You have new notification(s) in WWS');
            $mail->setBody(User::model()->findByPk($other_id)->username.' '.$nott->type);
            $mail->send();
        }
    }

    public static function following_count($id, $type = '') {
        $res = 0;
        $shops_ids = FollowShop::model()->findAllBySql('SELECT shop_id FROM `follow_shop` WHERE followers LIKE "' . $id . ',%" OR followers LIKE "%,' . $id . ',%" OR followers LIKE "%,' . $id . '" OR followers LIKE "' . $id . '";');
        if ($shops_ids) {
            $res = count($shops_ids);
        }

        $str = "Following " . $res;
        if ($type == 'shop') {
            $str = "0 Following";
            if ($res) {
                $str = $res." Following";
            }
        }

        return $str;
    }
	
	public static function get_follow_pro_notif()
	{
		$criteria= new CDbCriteria;
		$criteria->condition='follower_id='.Yii::app()->user->id;
		$criteria->addCondition('seen="0"');
		$all=FollowProNotif::model()->findAll($criteria);
		return count($all);
	}

}

?>