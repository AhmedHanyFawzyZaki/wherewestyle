<?php
$this->breadcrumbs = array(
    'From Banks' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Allowed Paying Banks', 'url' => array('index')),
    array('label' => 'Create Paying Bank', 'url' => array('create')),
    array('label' => 'Update Paying Bank', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Paying Bank', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Paying Bank #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'bank_name',
        'internet_banking_nickname',
        array(
            'name' => 'icon',
            'type' => 'raw',
            'value' => $model->image ? CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->image, $model->bank_name, array('style' => 'max-width: 200px;max-height: 250px;')) : "No image",
        ),
    ),
));
?>
