<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Pages', 'url' => array('index')),
    array('label' => 'Update Page', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Create Page', 'url' => array('create')),
);
?>



<h1>View - <?php echo $model->title; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'title',
        array(
            'name' => 'image',
            'type' => 'raw',
            'value' => $model->image ? CHtml::image(Yii::app()->request->baseUrl . '/media/pages/' . $model->image, $model->title, array('width' => 250)) : "No image",
        ),
//        array(
//            'name' => 'publish',
//            'type' => 'raw',
//            'value' => $model->getStatus($model->publish),
//        ),
    ),
));
?>


