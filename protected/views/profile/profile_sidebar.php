<div class="span3 user_controls">
    <ul class="nav nav-list">
        <li <?php if($this->action->Id=='index'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile">Profile</a></li>
        <li <?php if($this->action->Id=='messages' || $this->action->Id=='viewmessage'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/messages">Messages</a></li>
        <li <?php if($this->action->Id=='orders' || $this->action->Id=='orderDetails'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/orders">My Purchases</a></li>
        
        <?php $m_shop = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id)); ?>
        <?php if (Yii::app()->user->group == '2' && $m_shop) { ?>
            <li <?php if($this->action->Id=='shop' || $this->action->Id=='createshop'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/shop">Shop Settings</a></li>
            <li <?php if($this->action->Id=='products' || $this->action->Id=='createproduct' || $this->action->Id=='editproduct'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/products">Products</a></li>
            <li <?php if($this->action->Id=='payouts' && Yii::app()->request->getQuery('filter') != "completed"){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/payouts">Payouts</a></li>
            <li <?php if($this->action->Id=='payouts' && Yii::app()->request->getQuery('filter') == "completed"){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/payouts?filter=completed">Orders</a></li>
            <li <?php if($this->action->Id=='coupons'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/coupons">Coupons</a></li>
        <?php }else{ ?>
            <li <?php if($this->action->Id=='createshop'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/createshop">Create a Shop</a></li>
        <?php } ?>
        <li <?php if($this->action->Id=='settings'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/settings">Account Settings</a></li>
        <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/logout">Logout</a></li>
    </ul>
</div>