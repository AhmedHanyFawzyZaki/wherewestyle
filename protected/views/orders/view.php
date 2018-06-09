<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Orders', 'url' => array('index')),
    array('label' => 'Create Order', 'url' => array('create')),
    array('label' => 'Update Order', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Order', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php
$payment = array(
    'label' => '',
    'value' => '',
);

if ($model->payment_method == 2) {
    $payment = array(
        'label' => 'bank transfer info',
        'type' => 'raw',
        'value' => $model->get_pm(),
    );
}
?>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'user_id',
            'value' => $model->user->username,
        ),
        'first_name',
        'last_name',
        'email',
        array(
            'name' => 'status_id',
            'value' => $model->status->status,
        ),
        'order_date',
        array(
            'name' => 'total',
            'value' => $model->currency_rate == 1 ? $model->total : $model->total / $model->currency_rate,
        ),
        array(
            'name' => 'country_id',
            'value' => $model->country->country_name,
        ),
        'address',
        'phone',
        array(
            'name' => 'payment_method',
            'value' => $model->payment->title,
        ),
        $payment,
    ),
));
?>
