<?php
$this->breadcrumbs = array(
    'Currencies' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Currencies', 'url' => array('index')),
    array('label' => 'Create Currency', 'url' => array('create')),
    array('label' => 'Update Currency', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Currency', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Currency : <?php echo $model->title; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        'rate',
        'iso_code',
        array(
            'name' => 'symbol',
            'type' => 'raw',
        ),
        array(
            'name' => 'icon',
            'type' => 'raw',
            'value' => $model->icon ? CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->icon, $model->title, array('width' => 50)) : "No icon",
        ),
    ),
));
?>
