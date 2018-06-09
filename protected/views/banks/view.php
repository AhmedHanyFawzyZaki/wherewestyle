<?php
$this->breadcrumbs = array(
    'Banks' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Banks', 'url' => array('index')),
    array('label' => 'Create Bank Account', 'url' => array('create')),
    array('label' => 'Update Bank Account', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Bank Account', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Bank Account : <?php echo $model->name; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        'account_type',
        'account_name',
        'account_number',
        'bank_code',
        'branch_code',
        array(
            'name' => 'status',
            'value' => $model->status ? "Active" : "Not active",
        ),
        array(
            'name' => 'icon',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->icon, $model->name, array('style' => "max-width: 200px;")),
        ),
    ),
));
?>
