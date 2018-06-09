<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Orders', 'url' => array('index')),
    array('label' => 'Create Order', 'url' => array('create')),
);
?>

<h1>Manage Orders</h1>



<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //	'id',
        array(
            'name' => 'total',
            'value' => '$data->currency_rate == 1 ? $data->total : $data->total / $data->currency_rate',
        ),
        'user_id' => array(
            'name' => 'user_id',
            'value' => '$data->user->username',
            'filter' => User::model()->getUsers(),
        ),
        /* 'username',
          'first_name',
          'last_name', */
        'email',
        'status_id' => array(// display 'author.username' using an expression
            'name' => 'status_id',
            'value' => '$data->status->status',
            'filter' => OrderStatus::model()->getStatus(),
        ),
        'order_date',
        array(
            'class' => 'CLinkColumn',
            'label' => 'Details...',
            'urlExpression' => 'Yii::app()->request->baseUrl."/orderDetails/index?id=".$data->id',
            'header' => 'Details'
        ),
        /*
          'address',
          'token',
          'country_id',
          'phone',

         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
