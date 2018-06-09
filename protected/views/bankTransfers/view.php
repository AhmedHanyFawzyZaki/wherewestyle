<?php
$this->breadcrumbs = array(
    'Bank Transfers' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Bank Transfers', 'url' => array('index')),
//	array('label'=>'Create BankTransfers','url'=>array('create')),
//	array('label'=>'Update BankTransfers','url'=>array('update','id'=>$model->id)),
    array('label' => 'Delete Bank Transfer', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View BankTransfers #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'label' => 'Paid to Bank Account',
            'type' => 'raw',
            'value' => '<a href="' . Yii::app()->createUrl("banks/view", array("id" => $model->bank_account_id)) . '">' . $model->bank->name . " ( " . $model->bank->account_name . " )" . '</a>',
        ),
        'bank_name',
        'internet_banking_nickname',
        'transaction_date',
        array(
            'label' => 'Transaction Time',
            'value' => $model->transaction_hour . " : " . $model->transaction_minute,
        ),
        'transaction_reference_no',
        'amount_transfered',
        array(
            'name' => 'receipt',
            'type' => 'raw',
            'value' => $model->receipt ? CHtml::image(Yii::app()->request->baseUrl . '/media/receipts/' . $model->receipt, "receipt", array('width' => 250)) : "No receipt",
        ),
        'other_info',
        array(
            'label' => 'Order',
            'type' => 'raw',
            'value' => '<a href="' . Yii::app()->createUrl("orders/view", array("id" => $model->order_id)) . '">Order Info</a>',
        ),
        'date',
        array(
            'name' => 'status',
            'value' => $model->status ? "Verified" : "Not Verified Yet",
        ),
        array(
            'label' => 'Verify Payment',
            'type' => 'raw',
            'value' => $model->status ? "Done" : '<a href="' . Yii::app()->createUrl("bankTransfers/verify", array("id" => $model->order_id)) . '">Verify</a>',
        ),
    ),
));
?>
