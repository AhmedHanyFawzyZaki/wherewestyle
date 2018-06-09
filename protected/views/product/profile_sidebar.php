<div class="span3 user_controls">
    <ul class="nav nav-list">
        <li <?php if($this->action->Id=='profile'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile">Profile</a></li>
        <li <?php if($this->action->Id=='messages' || $this->action->Id=='viewmessage'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/messages">Messages</a></li>
        <li <?php if($this->action->Id=='orders' || $this->action->Id=='orderDetails'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/orders">My Purchases</a></li>
        <?php if (Yii::app()->user->group == '2') { ?>
            <li <?php if($this->action->Id=='shops' || $this->action->Id=='createshop'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/shops">Shops</a></li>
            <li <?php if($this->action->Id=='payouts'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/payouts">Payouts</a></li>
            <li <?php if($this->action->Id=='coupons'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/coupons">Coupons</a></li>
        <?php } ?>
        <li <?php if($this->action->Id=='settings'){ echo 'class="active"'; } ?>><a href="<?= Yii::app()->request->baseUrl; ?>/profile/settings">Account Setting</a></li>
    </ul>
</div>