<?php
$this->breadcrumbs = array(
    'Settings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Update Settings', 'url' => array('index')),
);
?>

<h1>View Settings </h1>





<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'facebook',
        'google',
        'twitter',
        'youtube',
        // 'pinterest',
        'email',
        'address',
        //'press_email',
        //'support_email',
        //'blog_email',
        //'paypal_email',
        //'api_username',
        //'api_password',
        //'signature',
        //'paypal_fee',
        //'paypalextra_fee',
        'contact_info',
        'faq_intro',
    ),
));
?>
