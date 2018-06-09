<div style="width: 100%;height: 400px;background: #fff;color: #000;margin-top: 200px;">
    <?php
    $loginUrl = Yii::app()->facebook->getLoginUrl();
    echo "<a href='".$loginUrl."'>hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</a>";
      //$results = Yii::app()->facebook->api('/me');
      // print_r($results);
      $user = Yii::app()->facebook->getUser();

        if ($user) {
          try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = Yii::app()->facebook->api('/me/friends');
            //print_r($user_profile['data']);
            foreach($user_profile['data'] as $t){
              echo $t['name'].'<img src="https://graph.facebook.com/'.$t["id"].'/picture"><br />';
                    }
          } catch (FacebookApiException $e) {
                //throw $e;
            $user = null;
          }
        }

    ?>
</div>