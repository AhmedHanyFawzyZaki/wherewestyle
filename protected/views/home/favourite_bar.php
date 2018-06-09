<?php if (!Yii::app()->user->isGuest) { ?>
    <?php
    $criteria = new CDbCriteria;
//    $criteria->condition = 'user_id=' . Yii::app()->user->id;
//    //$criteria->addCondition('active = 1');
//    $criteria->limit = 6;
//    $criteria->order = "id DESC";
    $criteria->select = 't.*';
    $criteria->join = 'INNER JOIN product as t2 ON t.pro_id = t2.id';
    $criteria->condition = "t2.active = 1";
    $criteria->addCondition("user_id = " . Yii::app()->user->id);
    $criteria->order = 't.id desc';
    $criteria->limit = 10;
    $favs = FavouriteProduct::model()->findAll($criteria);
    ?>
    <?php if ($favs) { ?>
        <div class="fav-bar">
            <ul id="favo_bar" class="scroll">
                <?php foreach ($favs as $index=>$fav) { 
					$id=' id="fav_pr_'.$fav->pro_id.'"';
				?>
                    <li class="dropdown" <?=$id;?> >
                        <?php
                        $pimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
                        if ($fav->pro->main_image) {
                            if (file_exists('media/products/thumbs_266X300/' . $fav->pro->main_image)) {
                                $pimage = Yii::app()->request->baseUrl . '/media/products/thumbs_266X300/' . $fav->pro->main_image;
                            }
                        }
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                            <!--<div class="s-image">-->
                            <div>
                                <img src="<?php echo $pimage; ?>">
                            </div>
                        </a>


                        <div class="dropdown-menu fav-drop relative">

                            <img pid='<?php echo $fav->pro->id; ?>' src="<?php echo Yii::app()->request->baseUrl; ?>/img/del.png" class="del delfav">
                            <div class="main-img">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $fav->pro->main_image; ?>"  /></div>

                            <div class="fav-left">
                                <span class="title"><?php echo $fav->pro->title; ?></span>
                                <?php
                                $curr_symbol = Yii::app()->params['dc_symbol'];
                                $rate = '1';
                                if (!Yii::app()->user->isGuest) {
                                    $curr_symbol = Yii::app()->user->getState('currency_symbol');
                                    $rate = Yii::app()->user->getState('currency_rate');
                                }
                                ?>

                                <span class="price"><?php echo $curr_symbol . "  " . $fav->pro->price * $rate; ?></span>
                                <?php if ($fav->pro->sale) { ?>
                                    <del class="org2"><?php echo $curr_symbol . "  " . $fav->pro->old_price * $rate; ?></del>
                                <?php } ?>
                            </div>

                            <button class="fav-btn carting1" pid="<?php echo $fav->pro->id; ?>" >
                                Add to cart<i class="icon-shopping-cart icon-white"></i></button>
                        </div>
                    </li>
                <?php } ?>


            </ul>

            <a href="<?php echo Yii::app()->createUrl('/home/favouriteProducts'); ?>" style="padding:5px 0; color:#FFF; width:100%; text-align:center; float:left; background:#F62A64;">View Saved</a>
        </div>
    <?php } ?>
<?php } ?>