

<ul class="breadcrumbs">
    <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>Dashboard</li>
    <li class="right">
        <ul class="dropdown-menu pull-right skin-color">
            <li><a href="default">Default</a></li>
            <li><a href="navyblue">Navy Blue</a></li>
            <li><a href="palegreen">Pale Green</a></li>
            <li><a href="red">Red</a></li>
            <li><a href="green">Green</a></li>
            <li><a href="brown">Brown</a></li>
        </ul>
    </li>
</ul>



<div class="pageheader">

    <div class="pageicon"><span class="iconfa-laptop"></span></div>
    <div class="pagetitle">
        <h1 class="kk">Dashboard</h1>

    </div>
    <div class="clock-chart-div" style=""></div>
</div>




<!--  the graph  global chart for users   display:none -->


<div class="chart-div" style="width:98%;display:none"></div>


<ul class="shortcuts">
    <li class="events">
        <a href="<?php echo Yii::app()->baseUrl; ?>/user" style="height: 145px;">
            <span class="shortcuts-icon iconsi-event"></span>
            <span class="shortcuts-label">Manage Users</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/settings" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Settings</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/newsletter" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Newsletter Subscribers</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/newsletterMessages" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Newsletter messages</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/currency" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Currency</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/banks" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Banks Accounts</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/fromBanks" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Paying Banks</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/bankTransfers" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">Bank Transfers</span>
        </a>
    </li>
    <li class="archive">
        <a href="<?php echo Yii::app()->baseUrl; ?>/posts" style="height: 145px;">
            <span class="shortcuts-icon iconsi-archive"></span>
            <span class="shortcuts-label">Manage Blog</span>
        </a>
    </li>
    <li class="archive">
        <a href="<?php echo Yii::app()->baseUrl; ?>/comments" style="height: 145px;">
            <span class="shortcuts-icon iconsi-archive"></span>
            <span class="shortcuts-label">Manage Blog Comments</span>
        </a>
    </li>
    <li class="archive">
        <a href="<?php echo Yii::app()->baseUrl; ?>/pages" style="height: 145px;">
            <span class="shortcuts-icon iconsi-archive"></span>
            <span class="shortcuts-label">Manage Pages</span>
        </a>
    </li>
    <li class="products">
        <a href="<?php echo Yii::app()->baseUrl; ?>/faq" style="height: 145px;">
            <span class="shortcuts-icon iconsi-cart"></span>
            <span class="shortcuts-label">FAQ</span>
        </a>
    </li>
    <li class="archive">
        <a href="<?php echo Yii::app()->baseUrl; ?>/banner" style="height: 145px;">
            <span class="shortcuts-icon iconsi-archive"></span>
            <span class="shortcuts-label">Manage Banners</span>
        </a>
    </li>
    <li class="archive">
        <a href="<?php echo Yii::app()->baseUrl; ?>/AllCountries" style="height: 145px;">
            <span class="shortcuts-icon iconsi-archive"></span>
            <span class="shortcuts-label">Manage Countries</span>
        </a>
    </li>
    <!-- <li class="help">
         <a href="<?php echo Yii::app()->baseUrl; ?>/faq">
             <span class="shortcuts-icon iconsi-help"></span>
             <span class="shortcuts-label">Manage FAQ</span>
         </a>
     </li>-->
    <li class="last images">
        <a href="<?php echo Yii::app()->baseUrl; ?>/dashboard/logout" style="height: 145px;">
            <span class="shortcuts-icon iconsi-images"></span>
            <span class="shortcuts-label">LogOut</span>
        </a>
    </li>

</ul>






<!--<div class="span9">

<ul class="dash">
      <li title="Adminstrators" class="" >
         <a href="<?php echo Yii::app()->baseUrl; ?>/user"> <img border="0" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/users.png">
          <span>Admin</span>
          </a>
        </li>
      <li class=""> <a href="<?php echo Yii::app()->baseUrl; ?>/settings"> <img border="0" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/users.png">
         <span>Settings</span>
         </a>
       </li>
      <li title="Manage Pages" class="" >
            <a href="<?php echo Yii::app()->baseUrl; ?>/pages"> <img border="0" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/users.png">
             <span>Manage Pages</span>
             </a>
         </li>
      <li title="Manage FAQ " class="" >
            <a href="<?php echo Yii::app()->baseUrl; ?>/faq">
             <img border="0" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/users.png"><span>Manage FAQ</span>
             </a>
         </li>
      <li title="End Current Session" class="" >
          <a href="<?php echo Yii::app()->baseUrl; ?>/dashboard/logout">
            <img border="0" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/users.png">
            <span>LogOut</span>
            </a>
        </li>

      </ul>

</div>-->

</div>



