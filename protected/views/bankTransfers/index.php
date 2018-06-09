<?php
$this->breadcrumbs = array(
    'Bank Transfers' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Bank Transfers', 'url' => array('index')),
//    array('label' => 'Create Bank Transfer', 'url' => array('create')),
);
?>

<h1>Manage Bank Transfers</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'bank-transfers-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'internet_banking_nickname',
        'bank_name',
        'transaction_date',
        'amount_transfered',
        'transaction_reference_no',
        /*
          'amount_transfered',
          'receipt',
          'other_info',
          'order_id',
          'date',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
